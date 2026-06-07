<?php

namespace App\Http\Controllers\Staff\Product;

use App\Http\Controllers\Controller;
use App\Models\GroupV2;
use App\Models\ListItemV2;
use App\Models\ResourceV2;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class AccountV2Controller extends Controller
{
    /**
     * Giao diện danh sách nhóm chuyên mục V2 được cấp quyền
     */
    public function index(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if ($user->colla_type !== 'account') {
            return redirect()->route('staff.dashboard');
        }

        // Lấy danh sách nhóm V2 mà CTV này được phép quản lý
        $groups = GroupV2::orderBy('id', 'desc')->whereIn('id', $user->staff_group_v2_ids ?? [])->get();

        return view('staff.products.accountsv2.groups', compact('groups'));
    }

    /**
     * Giao diện danh sách sản phẩm trong một nhóm cụ thể
     */
    public function items(Request $request, $id)
    {
        $user = User::find(auth()->user()->id);

        if ($user->colla_type !== 'account') {
            return redirect()->route('staff.dashboard');
        }

        // Kiểm tra bảo mật quyền truy cập nhóm của CTV
        if (!in_array($id, $user->staff_group_v2_ids ?? [])) {
            return redirect()->route('staff.products.accountsv2.groups');
        }

        $group = GroupV2::findOrFail($id);
        
        // LOGIC BẢO MẬT CHUẨN V2: 
        // Bước 1: Vào bảng phụ ResourceV2 lấy hết các mã 'code' (mã sản phẩm) chứa tài khoản do CTV này đăng vào nhóm này
        $myProductCodes = ResourceV2::where('group_id', $id)
                                    ->where('domain', $user->username) // Tận dụng cột domain (hoặc cột rảnh bất kỳ) để lọc, ở đây ta lấy danh sách code của chính mình
                                    ->pluck('code')
                                    ->toArray();

        // Bước 2: Chỉ hiển thị các sản phẩm gốc có mã 'code' trùng với danh sách tài khoản con của CTV này
        $items = ListItemV2::where('group_id', $id)
                            ->whereIn('code', $myProductCodes) 
                            ->orderBy('id', 'desc')
                            ->paginate(20);

        return view('staff.products.accountsv2.items', compact('group', 'items', 'user'));
    }

    /**
     * Xử lý thêm sản phẩm gốc và dồn danh sách tài khoản con vào bảng phụ
     */
    public function store(Request $request)
    {
        $payload = $request->validate([
            'id'          => 'required|exists:group_v2_s,id',
            'name'        => 'required|string|max:255',
            'priority'    => 'required|integer',
            'code'        => 'required|integer',
            'price'       => 'required|numeric|min:0',
            'cost'        => 'required|numeric|min:0',
            'status'      => 'required|boolean',
            'image'       => 'nullable|image|max:10240',
            'discount'    => 'required|integer|min:0|max:100',
            'is_bulk'     => 'required|integer|min:1',
            'list_item'   => 'required|string',
            'highlights'  => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $user  = User::find(auth()->user()->id);
        $group = GroupV2::findOrFail($payload['id']);

        // Kiểm tra quyền đăng bài vào nhóm này
        if (!in_array($group->id, $user->staff_group_v2_ids ?? [])) {
            return redirect()->route('staff.products.accountsv2.groups');
        }

        // Xử lý upload ảnh đại diện cho sản phẩm gốc
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = Helper::uploadFile($request->file('image'), 'public', 'items/' . $group->id);
        }

        // Tách danh sách tài khoản con gửi lên thành mảng
        $listItem = explode(PHP_EOL, $payload['list_item']);
        $listItem = array_filter(array_map('trim', $listItem));

        if (count($listItem) === 0) {
            return redirect()->back()->with('error', 'Vui lòng nhập danh sách tài khoản');
        }

        // Xử lý chuỗi thông tin nổi bật (highlights)
        $highlights = explode(PHP_EOL, $payload['highlights'] ?? '');
        $highlights = array_filter(array_map('trim', $highlights));
        $highlightsData = [];
        foreach ($highlights as $hl) {
            $parts = explode(':', $hl, 2);
            if (count($parts) === 2) {
                $highlightsData[] = ['name' => trim($parts[0]), 'value' => trim($parts[1])];
            } else {
                $highlightsData[] = trim($parts[0]);
            }
        }

        // Kiểm tra tránh trùng lặp mã code sản phẩm gốc ngoài hệ thống
        $finalCode = $payload['code'] <= 10 ? rand(100000, 999999) : $payload['code'];
        while (ListItemV2::where('code', $finalCode)->exists()) {
            $finalCode = rand(100000, 999999);
        }

        // --- BƯỚC 1: TẠO DUY NHẤT 1 SẢN PHẨM GỐC (Dọn sạch các trường không có trong database V2) ---
        $mainItem = ListItemV2::create([
            'group_id'    => $group->id,
            'name'        => $payload['name'],
            'priority'    => $payload['priority'],
            'code'        => $finalCode,
            'price'       => $payload['price'],
            'cost'        => $payload['cost'],
            'discount'    => $payload['discount'],
            'status'      => $payload['status'],
            'is_bulk'     => $payload['is_bulk'],
            'image'       => $imagePath,
            'amount'      => count($listItem), 
            'highlights'  => $highlightsData,
            'description' => Helper::htmlPurifier($payload['description'] ?? ''),
            'list_image'  => [],
            'revenue'     => 0,
        ]);

        // --- BƯỚC 2: DỒN TOÀN BỘ DANH SÁCH NICK CON VÀO BẢNG RESOURCE_V_2_S ---
        foreach ($listItem as $accountRaw) {
            $accountData = explode('|', $accountRaw);
            
            ResourceV2::create([
                'code'       => $mainItem->code, 
                'group_id'   => $group->id,      
                'username'   => $accountData[0] ?? '-',
                'password'   => $accountData[1] ?? '-',
                'extra_data' => $accountData[2] ?? null,
                
                // ĐÁNH DẤU CHỦ SỞ HỮU: Lưu tên CTV vào cột 'domain' có sẵn trong mảng fillable của ResourceV2 
                // để làm cột mốc phân chia quyền hiển thị và chặn quyền xem chéo dữ liệu giữa các CTV/Admin
                'domain'     => $user->username, 
            ]);
        }

        Helper::addHistory('CTV ' . $user->username . ' đăng sản phẩm V2 "' . $mainItem->name . '" dồn sẵn ' . count($listItem) . ' nick.');

        return redirect()->back()->with('success', 'Tạo sản phẩm V2 và dồn ' . count($listItem) . ' tài khoản thành công!');
    }

    /**
     * Xem chi tiết sản phẩm lẻ
     */
    public function show($id)
    {
        return redirect()->back()->with('error', 'Tính năng sửa lẻ đang được đồng bộ hóa hệ thống!');
    }

    /**
     * Cập nhật thông tin sản phẩm
     */
    public function update(Request $request)
    {
        return redirect()->back()->with('error', 'Tính năng cập nhật đang được đồng bộ hóa hệ thống!');
    }

    /**
     * API Xóa lẻ 1 sản phẩm gốc
     */
    public function delete(Request $request)
    {
        $item = ListItemV2::findOrFail($request->id);
        
        // Kiểm tra xem sản phẩm này có phải do CTV này nắm tài khoản tài nguyên không
        $isOwner = ResourceV2::where('code', $item->code)->where('domain', auth()->user()->username)->exists();
        
        if (!$isOwner) {
            return response()->json(['status' => 403, 'message' => 'Bạn không có quyền xóa sản phẩm này!']);
        }
        
        ResourceV2::where('code', $item->code)->delete();
        $item->delete();

        return response()->json(['status' => 200, 'message' => 'Xóa sản phẩm V2 thành công']);
    }

    /**
     * API Xóa hàng loạt nhiều sản phẩm gốc
     */
    public function deleteList(Request $request)
    {
        $ids = $request->ids ?? [];
        $items = ListItemV2::whereIn('id', $ids)->get();
        
        foreach ($items as $item) {
            $isOwner = ResourceV2::where('code', $item->code)->where('domain', auth()->user()->username)->exists();
            if ($isOwner) {
                ResourceV2::where('code', $item->code)->delete();
                $item->delete();
            }
        }

        return response()->json(['status' => 200, 'message' => 'Xóa danh sách sản phẩm V2 thành công']);
    }
}