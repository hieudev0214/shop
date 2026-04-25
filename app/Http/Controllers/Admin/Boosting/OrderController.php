<?php

namespace App\Http\Controllers\Admin\Boosting;

use App\Http\Controllers\Controller;
use App\Models\CollaTransaction;
use App\Models\GBOrder;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
  {
    $orders = GBOrder::get();

    return view('admin.boosting.orders.index', compact('orders'));
  }

  public function update(Request $request)
  {
    $payload = $request->validate([
      'id'         => 'required|exists:g_b_orders,id',
      'status'     => 'required|in:Pending,Processing,Completed,Cancelled',
      'admin_note' => 'nullable|string|max:255',
      'order_note' => 'nullable|string|max:255',
    ]);

    $order = GBOrder::findOrFail($payload['id']);

    if (in_array($order->status, ['Completed', 'Cancelled'])) {
      return redirect()->back()->with('error', 'Đơn hàng đã hoàn thành hoặc đã hủy');
    }

    $order->update($payload);

    if ($payload['status'] === 'Cancelled') {
      $client = User::find($order->user_id);

      if ($client) {
        $client->increment('balance', $order->payment);

        $client->transactions()->create([
          'code'           => $order->code,
          'amount'         => $order->payment,
          'balance_after'  => $client->balance,
          'balance_before' => $client->balance - $order->payment,
          'type'           => 'boosting-refund',
          'extras'         => [],
          'status'         => 'paid',
          'content'        => 'Hoàn tiền đơn cày thuê ' . $order->name,
          'user_id'        => $client->id,
          'username'       => $client->username,
        ]);

        $order->update([
          'payment' => 0,
        ]);
      }
    }

    Helper::addHistory('Cập nhật đơn hàng ' . $order->id . ' trạng thái ' . $payload['status']);

    return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
  }

  public function approvePayment($id)
  {
    $order = GBOrder::findOrFail($id);

    if ($order->assigned_status === 'Completed') {
      return redirect()->back()->with('error', 'Đơn này đã duyệt tiền rồi');
    }

    if ($order->assigned_status !== 'WaitPayment') {
      return redirect()->back()->with('error', 'Đơn này chưa ở trạng thái chờ duyệt');
    }

    if (!$order->assigned_to) {
  return redirect()->back()->with('error', 'Đơn chưa có CTV nhận');
}

$staff = User::where('username', $order->assigned_to)->first();

    if (!$staff) {
      return redirect()->back()->with('error', 'Không tìm thấy CTV');
    }

    $amount = (float) $order->assigned_payment;

    if ($amount <= 0) {
      $amount = (float) (($order->payment * $staff->colla_percent) / 100);
    }

    if ($amount <= 0) {
      return redirect()->back()->with('error', 'Số tiền duyệt không hợp lệ');
    }

    $before = $staff->colla_balance;
    $after  = $before + $amount;

    $staff->update([
      'colla_balance' => $after,
    ]);

    $order->update([
      'assigned_payment' => $amount,
      'assigned_status'  => 'Completed',
    ]);

    CollaTransaction::create([
      'type'           => 'boosting',
      'user_id'        => $staff->id,
      'username'       => $staff->username,
      'amount'         => $amount,
      'status'         => 'Completed',
      'reference'      => $order->code,
      'description'    => 'Duyệt tiền cày thuê đơn #' . $order->code,
      'balance_before' => $before,
      'balance_after'  => $after,
    ]);

    Helper::addHistory('Duyệt tiền CTV đơn cày thuê #' . $order->code);

    return redirect()->back()->with('success', 'Đã duyệt tiền CTV thành công');
  }
}