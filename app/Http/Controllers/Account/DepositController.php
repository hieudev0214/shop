<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Invoice;
use App\Models\User;
use App\Services\RaksmeypPayService;
use Exception;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
  public function index()
  {
    $banks        = BankAccount::where('status', true)->get();
    $card_configs = $config = Helper::getApiConfig('charging_card');

    $info           = Helper::getConfig('deposit_info');
    $deposit_prefix = $info['prefix'] ?? 'hello ';
    $deposit_prefix .= auth()->user()->id;
    $deposit_amount = 10000;

    $fees = $card_configs['fees'] ?? [];

    $cardOn = true;
    if (!isset($card_configs['api_url']) || !isset($card_configs['partner_id']) || !isset($card_configs['partner_key'])) {
      $cardOn = false;
    }

    return view('account.deposits.index', [
      'pageTitle' => 'Nạp Tiền Tài Khoản',
    ], compact('banks', 'deposit_prefix', 'deposit_amount', 'card_configs', 'fees', 'cardOn'));
  }

  public function crypto()
  {
    $config = Helper::getApiConfig('fpayment');

    if (!isset($config['address_wallet'])) {
      return redirect()->back()->with('error', 'Chưa cấu hình ví tiền điện tử.');
    }

    $invoices = Invoice::where('user_id', auth()->id())->where('type', 'fpayament')->simplePaginate(10);

    return view('account.deposits.crypto', [
      'pageTitle' => 'Nạp Tiền Tài Khoản Bằng Crypto',
    ], compact('config', 'invoices'));
  }

  public function invoice()
  {
    return view('account.deposits.invoice', [
      'pageTitle' => 'Tạo hóa đơn nạp tiền',
    ]);
  }

  public function paypal()
  {
    $config = Helper::getApiConfig('paypal');

    if (!isset($config['client_id'])) {
      return redirect()->back()->with('error', 'Chưa cấu hình ví tiền điện tử.');
    }

    $invoices = Invoice::where('user_id', auth()->id())->where('type', 'paypal')->orderBy('id', 'desc')->simplePaginate(10);

    return view('account.deposits.paypal', [
      'pageTitle' => 'Nạp Tiền Tài Khoản Bằng Paypal',
    ], compact('config', 'invoices'));
  }



  public function raksmeypay()
  {
    $config = Helper::getApiConfig('raksmeypay');

    if (!isset($config['profile_id']) || !isset($config['profile_key'])) {
      return redirect()->back()->with('error', 'Chưa cấu hình tài khoản RaksmeypPay.');
    }


    Invoice::where('user_id', auth()->id())
      ->where('type', 'raksmeypay')
      ->where('status', 'processing')
      ->where('expired_at', '<=', now())
      ->update(['status' => 'cancelled']);

    $invoices = Invoice::where('user_id', auth()->id())->where('type', 'raksmeypay')->orderBy('id', 'desc')->simplePaginate(10);

    return view('account.deposits.raksmeypay', [
      'pageTitle' => 'Nạp Tiền Tài Khoản Bằng RaksmeypPay',
    ], compact('config', 'invoices'));
  }

  public function raksmeypaySuccess(Request $request)
  {
    $amount        = $request->get('amount');
    $invoiceId     = $request->get('invoice_id');
    $transactionId = $request->get('transaction_id');

    if (!$transactionId || !$invoiceId) {
      return redirect()->route('account.deposits.raksmeypay')
        ->with('error', 'Thông tin giao dịch không hợp lệ.');
    }

    // Find the invoice
    $invoice = Invoice::where('id', $invoiceId)
      ->where('user_id', auth()->id())
      ->where('type', 'raksmeypay')
      ->first();

    if (!$invoice) {
      return redirect()->route('account.deposits.raksmeypay')
        ->with('error', 'Không tìm thấy hóa đơn.');
    }

    if ($invoice->status === 'processing') {
      try {
        // Verify payment with RaksmeypPay
        $raksmeypay = new RaksmeypPayService();

        $verifyResult = $raksmeypay->verifyPayment($transactionId);

        if (isset($verifyResult['payment_status']) && $verifyResult['payment_status'] !== 'SUCCESS') {
          return response()->json([
            'status'  => 400,
            'message' => 'Không thể xác minh thanh toán với RaksmeypPay.',
          ], 400);
        }

        $paymentData = $verifyResult['data'];

        $paymentStatus = strtoupper($paymentData['payment_status']);
        $paymentAmount = $paymentData['payment_amount'];

        // Check if payment is successful
        if ($paymentStatus === 'SUCCESS' && $paymentAmount == $invoice->payment_details['payment_amount']) {
          $user = User::find($invoice->user_id);
          if (!$user) {
            return response()->json(['status' => 400, 'message' => 'Can\'t not find user'], 400);
          }

          $amount = $invoice->amount;

          // Update invoice status
          $invoice->update([
            'status'          => 'completed',
            'paid_at'         => now(),
            'expired_at'      => now(),
            'description'     => 'Payment confirmed',
            'payment_details' => array_merge($invoice->payment_details, [
              'confirmed_at'            => now()->toISOString(),
              'verify_result'           => $verifyResult,
              'payment_status'          => $paymentStatus,
              'payment_amount_received' => $paymentAmount,
            ]),
          ]);

          // Add balance to user
          $user->increment('balance', $amount);
          $user->increment('total_deposit', $amount);

          // Create transaction record
          $user->transactions()->create([
            'code'           => $invoice->code,
            'amount'         => (int) $amount,
            'order_id'       => $transactionId,
            'balance_after'  => $user->balance,
            'balance_before' => $user->balance - $amount,
            'type'           => 'deposit',
            'extras'         => $verifyResult,
            'status'         => 'paid',
            'content'        => 'RaksmeypPay Payment #' . $transactionId . ', invoice #' . $invoice->id,
            'user_id'        => $user->id,
            'username'       => $user->username,
          ]);

          $usdAmount = $invoice->payment_details['usd_amount'] ?? ($invoice->payment_details['payment_amount'] ?? 0);

          Log::info('RaksmeypPay Payment Confirmed', [
            'transaction_id' => $transactionId,
            'user_id'        => $user->id,
            'amount_vnd'     => $amount,
            'amount_usd'     => $usdAmount,
          ]);

        } else {
          // Payment not successful or amount mismatch
          $invoice->update([
            'status'          => 'cancelled',
            'description'     => 'Payment verification failed',
            'payment_details' => array_merge($invoice->payment_details, [
              'verification_failed_at' => now()->toISOString(),
              'verify_result'          => $verifyResult,
            ]),
          ]);

          return response()->json([
            'status'  => 400,
            'message' => 'Thanh toán không thành công hoặc số tiền không khớp.',
          ], 400);
        }

      } catch (Exception $e) {
        Log::error('RaksmeypPay Payment Confirmation Error', [
          'transaction_id' => $transactionId,
          'invoice_id'     => $invoiceId,
          'error'          => $e->getMessage(),
          'trace'          => $e->getTraceAsString(),
        ]);

        return response()->json([
          'status'  => 500,
          'message' => 'Lỗi hệ thống khi xác nhận thanh toán: ' . $e->getMessage(),
        ], 500);
      }
    }

    return view('account.deposits.raksmeypay-success', [
      'pageTitle' => 'Xác Nhận Thanh Toán RaksmeypPay',
    ], compact('invoice', 'transactionId', 'amount'));
  }

  public function perfectMoney()
  {
    $config = Helper::getApiConfig('perfect_money');

    if (!isset($config['account_id'])) {
      return redirect()->back()->with('error', 'Chưa cấu hình tài khoản Perfect Money.');
    }

    $user      = auth()->user();
    $invoice   = Invoice::where('user_id', auth()->id())->where('type', 'perfect_money')->where('status', 'processing')->first();
    $requestId = Helper::randomString(10);

    if ($invoice === null) {
      $invoice = Invoice::create([
        'code'        => 'PM-' . Helper::randomString(7, true),
        'type'        => 'perfect_money',
        'status'      => 'processing',
        'amount'      => 0,
        'user_id'     => auth()->id(),
        'username'    => auth()->user()->username,
        'currency'    => 'USD',
        'request_id'  => $requestId,
        'description' => 'Nạp tiền tài khoản bằng Perfect Money',
      ]);
    }

    $params = [
      'API_URL'        => 'https://perfectmoney.is/api/step1.asp',
      'PAYMENT_ID'     => $invoice->request_id,
      // mã giao dịch không trùng lặp để lưu lên hệ thống
      'PAYEE_ACCOUNT'  => $config['account_id'],
      // mã tài khoản Perfect Money
      'PAYMENT_UNITS'  => 'USD',
      // đơn vị tiền tệ,
      'PAYEE_NAME'     => $user->username,
      // tên người thanh toán
      'PAYMENT_URL'    => route('account.deposits.perfect-money'),
      // URL của hoá đơn
      'NOPAYMENT_URL'  => route('account.deposits.perfect-money'),
      // URL của hoá đơn
      'STATUS_URL'     => route('cron.deposit.pm-callback'),
      // Webhook callback
      'SUGGESTED_MEMO' => 'Payment - ' . $invoice->code
    ];

    $invoices = Invoice::where('user_id', auth()->id())->where('type', 'perfect_money')->where('status', 'completed')->simplePaginate(10);

    return view('account.deposits.perfect_money', [
      'pageTitle' => 'Nạp Tiền Tài Khoản Bằng Perfect Money',
    ], compact('config', 'invoices', 'invoice', 'params'));
  }
}
