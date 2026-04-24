<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Models\ItemData;
use App\Models\ItemGroup;
use App\Models\ItemOrder;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  public function index(Request $request)
  {
    $payload    = $request->validate([
      'page'       => 'nullable|integer',
      'limit'      => 'nullable|integer',
      'price'      => 'nullable|string',
      'search'     => 'nullable|string',
      'sort_by'    => 'nullable|string',
      'group_id'   => 'required|integer',
      'sort_type'  => 'nullable|string|in:asc,desc',
      'display_by' => 'nullable|string|in:created_at_asc,created_at_desc,price_asc,price_desc,priority_asc,priority_desc',
    ]);
    $page       = $payload['page'] ?? 1;
    $limit      = $payload['limit'] ?? 10;
    $search     = $payload['search'] ?? null;
    $offset     = ($page - 1) * $limit;
    $sort_by    = $payload['sort_by'] ?? 'id';
    $sort_type  = $payload['sort_type'] ?? 'desc';
    $display_by = $payload['display_by'] ?? null;

    $group = ItemGroup::where('id', $payload['group_id'])->where('status', true)->first();

    if ($group === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy nhóm dịch vụ này',
      ], 400);
    }

    $query = $group->data()->where('status', true);

    if (isset($search)) {
      if (is_numeric($search)) {
        $query = $query->where('code', $search);
      } else {
        $query = $query->where(function ($q) use ($search) {
          $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%');
        });
      }
    }

    if (isset($payload['sort_by'])) {
      $query = $query->orderBy($sort_by, $sort_type);
    }

    if (isset($payload['price'])) {
      $price = explode('-', $payload['price']);
      if (count($price) === 2) {
        if (is_numeric($price[0]) && is_numeric($price[1])) {
          if ($price[1] <= 0) {
            $query = $query->where('price', '>=', $price[0]);
          } else {
            $query = $query->whereBetween('price', [$price[0], $price[1]]);
          }
        }
      }
    }

    $meta = [
      'page'       => (int) $page,
      'limit'      => (int) $limit,
      'total_rows' => $query->count(),
      'total_page' => ceil($query->count() / $limit),
    ];

    if ($display_by !== null) {
      if ($display_by === 'created_at_asc') {
        $query = $query->orderBy('created_at', 'asc');
      } else if ($display_by === 'created_at_desc') {
        $query = $query->orderBy('created_at', 'desc');
      } else if ($display_by === 'price_asc') {
        $query = $query->orderBy('price', 'asc');
      } else if ($display_by === 'price_desc') {
        $query = $query->orderBy('price', 'desc');
      } else if ($display_by === 'priority') {
        $query = $query->orderBy('priority', 'asc');
      } else if ($display_by === 'priority_desc') {
        $query = $query->orderBy('priority', 'desc');
      }
    } else {
      $query = $query->orderBy('priority', 'desc')->orderBy($sort_by, $sort_type);
    }

    $data = $query->skip($offset)
      ->take($limit)
      ->get();

    return response()->json([
      'data'    => [
        'meta' => $meta,
        'data' => $data,
      ],
      'status'  => 200,
      'message' => 'Lấy danh sách vật phẩm thành công',
    ], 200);
  }

  public function show($code)
  {
    $item = ItemData::where('code', $code)->first();

    if ($item === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy sản phẩm này',
      ], 400);
    }

    if ($item->is_sold === true) {
      return response()->json([
        'status'  => 400,
        'message' => 'Sản phẩm này đã được bán',
      ], 400);
    }

    return response()->json([
      'data'    => $item,
      'status'  => 200,
      'message' => 'Lấy thông tin vật phẩm thành công',
    ], 200);
  }

  public function buy(Request $request, $code)
  {

    $item = ItemData::where('code', $code)->where('status', true)->first();

    if ($item === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy sản phẩm này',
      ], 400);
    }

    $user = User::find($request->user()?->id);

    if ($user === null) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không xác thực được thông tin người dùng',
      ], 400);
    }

    if ($item->type === 'addfriend') {
      $payload = $request->validate([
        'user_note' => 'nullable|string|max:255',
        'Tai_Khoan' => 'required|string',
      ], ['required' => ':attribute không được để trống'], ['Tai_Khoan' => 'Tài khoản']);
    } else if ($item->type === 'user_pass') {
      $message      = [
        'required' => 'Vui lòng nhập :attribute',
        'string'   => ':attribute phải là chuỗi',
      ];
      $attributes   = [
        'Lien_He'        => 'Liên hệ',
        'Mat_Khau'       => 'Mật khẩu',
        'Tai_Khoan'      => 'Tài khoản',
        'Dang_Nhap_Bang' => 'Loại đăng nhập',
      ];
      $DangNhapBang = ["Riot", "Garena", "Steam", "Facebook", "Google", "Roblox", "Other"];

      if (is_array($item->group->login_with)) {
        $DangNhapBang = $item->group->login_with ?? $DangNhapBang;
      }

      $payload = $request->validate([
        'Lien_He'        => 'nullable|string',
        'Ten_Game'       => 'nullable|string',
        'Mat_Khau'       => 'nullable|string',
        'Tai_Khoan'      => 'nullable|string',
        'user_note'      => 'nullable|string|max:255',
        'Dang_Nhap_Bang' => 'required|string',
      ], $message, $attributes);

      if (!in_array($payload['Dang_Nhap_Bang'], $DangNhapBang)) {
        return response()->json([
          'status'  => 400,
          'message' => 'Loại đăng nhập không hợp lệ, vui lòng kiểm tra lại',
        ], 400);
      }
    }

    if (!is_numeric($item->payment) || $item->payment <= 0) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không thể tính tiền, vui lòng thử lại',
      ], 400);
    }

    if ($item->payment === 0) {
      $timeWait   = setting('time_wait_free', 10); // seconds
      $lastAction = $user->last_action; // timestamp

      if ($lastAction !== null) {
        $timeDiff = now()->diffInSeconds($lastAction);

        if ($timeDiff < $timeWait) {
          return response()->json([
            'status'  => 400,
            'message' => __t('Bạn cần chờ') . ' ' . ($timeWait - $timeDiff) . ' ' . __t('giây để mua tài khoản miễn phí'),
          ], 400);
        }
      }

      $user->update([
        'last_action' => now(),
      ]);
    }

    if ($user->balance < $item->payment) {
      $require = $item->payment - $user->balance;

      return response()->json([
        'status'  => 400,
        'message' => 'Bạn còn thiếu ' . Helper::formatCurrency($require) . ' để mua!',
      ], 400);
    }

    if (!$user->decrement('balance', $item->payment) && $item->payment > 0) {
      return response()->json([
        'status'  => 400,
        'message' => __t('Không thể trừ tiền, vui lòng thử lại'),
      ], 400);
    }

    $item->update([
      'sold_count' => $item->sold_count + 1,
    ]);

    $order = ItemOrder::create([
      'code'           => 'OG-' . Helper::randomString(8, true),
      'type'           => $item->type,
      'name'           => $item->name,
      'image'          => $item->image,
      'data'           => [
        'id' => $item->id,
      ],
      'robux'          => $item->robux,
      'robox_rate'     => setting('rate_robux', 100),
      'payment'        => $item->payment,
      'discount'       => $item->discount,
      'status'         => 'Pending',
      'input_user'     => $payload['Tai_Khoan'] ?? '-',
      'input_pass'     => $payload['Mat_Khau'] ?? '-',
      'input_auth'     => $payload['Dang_Nhap_Bang'] ?? '-',
      'input_ingame'   => $item->type === 'addfriend' ? $item->ingame_list : [],
      'input_ingame_n' => $payload['Ten_Game'] ?? '-',
      'input_contact'  => $payload['Lien_He'] ?? '-',
      'user_id'        => $user->id,
      'username'       => $user->username,
      'admin_note'     => '',
      'order_note'     => $payload['user_note'] ?? '',
      'extra_data'     => $payload,
    ]);

    $user->transactions()->create([
      'code'           => $order->code,
      'amount'         => $item->payment,
      'balance_after'  => $user->balance,
      'balance_before' => $user->balance + $item->payment,
      'type'           => 'item-buy',
      'extras'         => [
        'group_id'   => $item->group_id,
        'account_id' => $item->id,
      ],
      'status'         => 'paid',
      'content'        => 'Mua dịch vụ ' . $item->name . '; Nhóm ' . $item->group->name,
      'user_id'        => $user->id,
      'username'       => $user->username,
    ]);

    try {
      $ref = $user->referrer;
      if ($ref !== null) {
        $affiliate = $ref->affiliate;
        if ($affiliate !== null) {
          $affiliate->increment('total_item_buy');
        }
      }

      Helper::sendMessageTelegram("📦📦📦 ĐƠN HÀNG VẬT PHẨM 📦📦📦\nMã đơn: " . $order->code . "\nDịch vụ: " . $order->name . "\nThanh toán: " . Helper::formatCurrency($order->payment) . "\nTài khoản: " . $user->username . "\nGhi chú: " . $order->order_note . "\nThời gian: " . $order->created_at . "\n");

      Helper::sendMail([
        'cc'      => setting('email'),
        'to'      => $user->email,
        'subject' => 'Đơn hàng vật phẩm ' . $order->code . ' của bạn đã được tạo',
        'content' => "Xin chào, <strong>{$user->username}</strong><br><br>Dịch vụ: <strong>{$order->name}</strong><br /><br />Đơn hàng: <strong>{$order->code}</strong> của bạn đã được tạo thành công.<br><br>Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.<br><br>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br><br>Trân trọng,<br><strong>Team " . config('app.name') . "</strong>",
      ]);

    } catch (\Exception $e) {
      // loi
    }

    return response()->json([
      'data'    => [
        'code' => $order->code,
      ],
      'status'  => 200,
      'message' => 'Đặt hàng thành công, vui lòng đợi xử lý',
    ], 200);
  }
}
