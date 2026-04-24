<?php

namespace App\Http\Controllers\Api\Deposit;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use App\Services\RaksmeypPayService;
use Exception;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RaksmeypPayController extends Controller
{
  protected RaksmeypPayService $raksmeypay;

  public function __construct(RaksmeypPayService $raksmeypay)
  {
    $this->raksmeypay = $raksmeypay;
  }

  /**
   * Tạo payment request với RaksmeypPay
   */
  public function create(Request $request)
  {
    if (!feature_enabled('gateway_raksmeypay')) {
      return response()->json([
        'status'  => 400,
        'message' => 'Chức năng này không được hỗ trợ, vui lòng liên hệ admin để được hỗ trợ.',
      ], 400);
    }

    $payload = $request->validate([
      'amount'   => 'required|numeric|min:1|max:10000',
      'currency' => 'sometimes|in:USD',
    ]);

    $user   = User::findOrFail($request->user()->id);
    $config = Helper::getApiConfig('raksmeypay');

    if (!isset($config['profile_id']) || !isset($config['profile_key'])) {
      return response()->json([
        'status'  => 400,
        'message' => 'Không tìm thấy cấu hình cổng thanh toán RaksmeypPay. Vui lòng liên hệ admin để cấu hình Profile ID và Profile Key.',
      ], 400);
    }

    $existingInvoice = Invoice::where('user_id', $user->id)
      ->where('type', 'raksmeypay')
      ->where('status', 'processing')
      ->get();

    if ($existingInvoice->count() > 3) {
      return response()->json([
        'status'  => 400,
        'message' => 'Bạn đã tạo quá 3 giao dịch thanh toán.',
      ], 400);
    }

    $invoice = null;

    try {
      // Generate unique transaction ID
      $transactionId = $this->raksmeypay->generateTransactionId('RMP');

      // Convert USD to VND for internal storage
      $usdAmount = $this->raksmeypay->formatAmount($payload['amount']);
      $vndAmount = $usdAmount * ($config['exchange'] ?? 26000);

      // Format amount for RaksmeypPay
      $paymentAmount = $this->raksmeypay->formatAmount($usdAmount);

      // Create invoice first
      $invoice = Invoice::create([
        'code'            => 'RMP-' . Helper::randomString(7, true),
        'type'            => 'raksmeypay',
        'status'          => 'processing',
        'amount'          => $vndAmount,
        'user_id'         => $user->id,
        'username'        => $user->username,
        'trans_id'        => $transactionId,
        'request_id'      => $transactionId,
        'currency'        => $payload['currency'] ?? 'USD',
        'description'     => "RaksmeypPay deposit $${usdAmount} - Pending payment",
        'payment_details' => [
          'usd_amount'     => $usdAmount,
          'vnd_amount'     => $vndAmount,
          'exchange_rate'  => $config['exchange'] ?? 26000,
          'payment_amount' => $paymentAmount,
        ],
        'paid_at'         => null,
        'expired_at'      => now()->addHours(6),
      ]);

      // Prepare success URL with invoice tracking
      $successUrl = route('account.deposits.raksmeypay-success', [
        'invoice_id'     => $invoice->id,
        'transaction_id' => $transactionId,
      ]);

      // Prepare payment data for RaksmeypPay
      $paymentData = [
        'amount'         => $usdAmount,
        'success_url'    => urlencode($successUrl),
        'transaction_id' => $transactionId,
      ];

      // Create payment link
      $result = $this->raksmeypay->createPaymentLink($paymentData);

      if (!$result['success']) {
        $invoice->update([
          'status'      => 'cancelled',
          'description' => 'Failed to create payment link',
        ]);

        return response()->json([
          'status'  => 400,
          'message' => 'Không thể tạo link thanh toán. Vui lòng thử lại sau.',
        ], 400);
      }

      // Update invoice with payment link details
      $invoice->update([
        'payment_details' => array_merge($invoice->payment_details, [
          'payment_link' => $result['payment_link'],
          'created_at'   => now()->toISOString(),
        ]),
      ]);

      Log::info('RaksmeypPay Payment Created', [
        'user_id'        => $user->id,
        'invoice_id'     => $invoice->id,
        'transaction_id' => $transactionId,
        'amount_usd'     => $usdAmount,
        'amount_vnd'     => $vndAmount,
      ]);

      return response()->json([
        'status'  => 200,
        'message' => 'Tạo giao dịch thanh toán thành công',
        'data'    => [
          'invoice_id'     => $invoice->id,
          'transaction_id' => $transactionId,
          'payment_link'   => $result['payment_link'],
          'amount_usd'     => number_format($usdAmount, 2, '.', ''),
          'amount_vnd'     => number_format($vndAmount, 0, '.', ''),
          'expires_at'     => $invoice->expired_at->toISOString(),
        ],
      ], 200);

    } catch (Exception $e) {
      if ($invoice) {
        $invoice->update([
          'status'      => 'cancelled',
          'description' => 'Error: ' . $e->getMessage(),
        ]);
      }

      Log::error('RaksmeypPay Payment Creation Error', [
        'user_id' => $user->id,
        'error'   => $e->getMessage(),
        'trace'   => $e->getTraceAsString(),
      ]);

      return response()->json([
        'status'  => 500,
        'message' => 'Lỗi hệ thống khi tạo giao dịch thanh toán: ' . $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Xác nhận thanh toán từ RaksmeypPay success callback
   */
  public function confirm(Request $request)
  {
    return $payload = $request->validate([
      'invoice_id'     => 'required|integer|exists:invoices,id',
      'transaction_id' => 'required|string',
    ]);

    $invoiceId     = $payload['invoice_id'];
    $transactionId = $payload['transaction_id'];

    try {
      $invoice = Invoice::findOrFail($invoiceId);

      if ($invoice->status !== 'processing') {
        return response()->json([
          'status'  => 400,
          'message' => 'Hóa đơn này đã được xử lý hoặc đã hết hạn.',
        ], 400);
      }

      if ($invoice->trans_id !== $transactionId) {
        return response()->json([
          'status'  => 400,
          'message' => 'Mã giao dịch không khớp.',
        ], 400);
      }

      // Verify payment with RaksmeypPay
      $verifyResult = $this->raksmeypay->verifyPayment($transactionId);

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
          'description'     => 'RaksmeypPay payment completed - Transaction ID: ' . $transactionId,
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
          'content'        => 'Payment confirmed',
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

        return response()->json([
          'status'  => 200,
          'message' => "Successfully deposited $${usdAmount} USD to your account",
          'data'    => [
            'amount_usd'     => $usdAmount,
            'amount_vnd'     => $amount,
            'new_balance'    => $user->balance,
            'transaction_id' => $transactionId,
          ],
        ], 200);
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

  /**
   * Check config setup
   */
  public function checkConfig()
  {
    try {
      $result = $this->raksmeypay->checkConfig();

      return response()->json($result);
    } catch (Exception $e) {
      return response()->json([
        'status'  => 'ERROR',
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Test connection
   */
  public function testConnection()
  {
    try {
      $result = $this->raksmeypay->testConnection();

      return response()->json($result, $result['success'] ? 200 : 400);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], 500);
    }
  }

  /**
   * Debug hash generation
   */
  public function debugHash(Request $request)
  {
    try {
      $testData = [
        'transaction_id' => $request->get('transaction_id', 'TEST-' . time()),
        'amount'         => $request->get('amount', 1.00),
        'success_url'    => $request->get('success_url', config('app.url') . '/test'),
      ];

      $result = $this->raksmeypay->debugHashGeneration($testData);

      return response()->json($result);
    } catch (Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage(),
      ], 500);
    }
  }
}
