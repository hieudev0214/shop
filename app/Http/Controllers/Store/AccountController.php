<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ListItem;

  use GuzzleHttp\Client;

class AccountController extends Controller
{
  public function index($slug)
  {
    $group = \App\Models\Group::where('status', true)->where('slug', $slug)->firstOrFail();

    $meta_seo = $group->meta_seo;

    return view('store.account', compact('group', 'meta_seo'), [
      'pageTitle' => 'Xem sản phẩm ' . $group->name,
    ]);
  }

  public function show($code)
  {
    $item = ListItem::where('code', $code)->firstOrFail();

    if ($item === null) {
      return redirect(route('home'))->with('error', 'Không tìm thấy sản phẩm này!');
    }

    if ($item->is_sold === true && $item->buyer_name !== auth()->user()?->username) {
      // return redirect()->back()->with('error', 'Sản phẩm này đã được bán!');
      return abort(403);
    }

    // --- ĐOẠN ĐÃ SỬA: Bỏ điều kiện lọc cột is_sold bị lỗi ---
    $related_accounts = ListItem::where('group_id', $item->group_id) // Cùng nhóm (danh mục)
                                ->where('code', '!=', $code)         // Loại trừ nick đang xem
                                ->inRandomOrder()                    // Lấy ngẫu nhiên
                                ->limit(4)                           // Lấy đúng 4 nick
                                ->get();

    // Truyền thêm biến related_accounts sang giao diện bằng hàm compact()
    return view('store.account-show', compact('item', 'related_accounts'), [
      'pageTitle' => 'Xem sản phẩm ' . $item->name,
    ]);
  }

  // HÀM CHAT AI CHUẨN KHÔNG CÒN BỊ LỖI TRAIT:
    public function chatAI(\Illuminate\Http\Request $request)
    {
        $userInput = mb_strtolower(trim($request->input('message')), 'UTF-8');

        // BỘ CÂU TRẢ LỜI KỊCH BẢN TỰ ĐỘNG - KHÔNG PHỤ THUỘC GOOGLE
        if (str_contains($userInput, 'zalo') || str_contains($userInput, 'admin') || str_contains($userInput, 'ad')) {
            $reply = "🔥 Hotline/Zalo Admin hỗ trợ duy nhất tại ShopTQ4: 0369679388 (Hiểu IT). Bạn nhắn tin qua Zalo để được hỗ trợ kiểm tra tài khoản nhanh nhất nhé! ⚡";
        } 
        elseif (str_contains($userInput, 'uy tín') || str_contains($userInput, 'lừa đảo')) {
            $reply = "🌸 Bạn hoàn toàn yên tâm khi giao dịch tại SHOPTQ4.COM! Shop bán acc tự động uy tín 100%, hệ thống đã xử lý thành công hàng ngàn đơn hàng và có chính sách bảo hành rõ ràng cho mọi tài khoản lỗi! 🔥";
        } 
        elseif (str_contains($userInput, 'nạp') || str_contains($userInput, 'card') || str_contains($userInput, 'atm')) {
            $reply = "⚡ Hướng dẫn nạp tiền tại Shop:\n1. Nạp Thẻ Cào: Hệ thống duyệt tự động 24/7 (Có chiết khấu).\n2. Nạp Ví/ATM: Bạn vào mục 'Nạp Tiền' chuyển khoản theo đúng nội dung hệ thống cấp để nhận ngay 100% số tiền sau 30 giây! 🔥";
        } 
        elseif (str_contains($userInput, 'free fire') || str_contains($userInput, 'ff') || str_contains($userInput, 'acc')) {
            $reply = "🔥 Shop hiện đang sẵn rất nhiều acc Free Fire giá siêu rẻ từ 2.5k, acc vip có skin súng xịn xò và túi mù may mắn! Bạn ra trang chủ bấm vào mục danh mục sản phẩm để lựa chọn nhé! 🚀";
        } 
        // Menu gợi ý thông minh nếu khách gõ câu lệnh khác hoặc gõ linh tinh
        else {
            $reply = "🤖 Bạn cần SHOPTQ4 hỗ trợ vấn đề gì ạ? Hãy gõ các từ khóa dưới đây để tôi trả lời ngay lập tức nhé:\n\n"
                   . "👉 Gõ 'zalo' hoặc 'ad': Lấy thông tin liên hệ Admin.\n"
                   . "👉 Gõ 'uy tín': Xem chính sách bảo mật của shop.\n"
                   . "👉 Gõ 'nạp tiền': Hướng dẫn nạp ATM/Thẻ cào.\n"
                   . "👉 Gõ 'acc': Xem danh sách nick game ngon giá rẻ.";
        }

        return response()->json(['reply' => $reply]);
    }
}