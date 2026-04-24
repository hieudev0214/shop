<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Exception;
use Helper;

class RaksmeypPayService
{
  protected string $paymentUrl;
  protected string $verifyUrl;
  protected string $profileId;
  protected string $profileKey;
  protected bool $sandbox;

  public function __construct()
  {
    // Get config from admin panel (database) instead of .env
    $config = Helper::getApiConfig('raksmeypay', []);

    $this->profileId  = $config['profile_id'] ?? config('raksmeypay.profile_id') ?? throw new Exception('RAKSMEYPAY_PROFILE_ID is required');
    $this->profileKey = $config['profile_key'] ?? config('raksmeypay.profile_key') ?? throw new Exception('RAKSMEYPAY_PROFILE_KEY is required');
    $this->sandbox    = $config['sandbox'] ?? config('raksmeypay.sandbox', true);

    // Build URLs with profile ID
    $baseUrl          = $config['base_url'] ?? config('raksmeypay.base_url', 'https://raksmeypay.com');
    $this->paymentUrl = "{$baseUrl}/payment/request/{$this->profileId}";
    $this->verifyUrl  = "{$baseUrl}/api/payment/verify/{$this->profileId}";
  }

  /**
   * Generate unique transaction ID
   */
  public function generateTransactionId(string $prefix = 'RMP'): string
  {
    // return $prefix . '-' . time() . '-' . rand(1000, 9999);
    return time();
  }

  /**
   * Format amount for RaksmeypPay
   */
  public function formatAmount(float $amount): float
  {
    return floatval($amount);
  }

  /**
   * Generate hash for payment request
   */
  private function generateHash(string $transactionId, float $amount, string $successUrl): string
  {
    $data = $this->profileKey . $transactionId . $amount . $successUrl;

    return sha1($data);
  }

  /**
   * Generate hash for payment verification
   */
  private function generateVerifyHash(string $transactionId): string
  {
    $data = $this->profileKey . $transactionId;

    return sha1($data);
  }

  /**
   * Create payment link
   */
  public function createPaymentLink(array $paymentData): array
  {
    $this->validatePaymentData($paymentData);

    $amount        = $this->formatAmount($paymentData['amount']);
    $successUrl    = $paymentData['success_url'];
    $transactionId = $paymentData['transaction_id'];

    $hash = $this->generateHash($transactionId, $amount, $successUrl);

    $parameters       = [
      "transaction_id" => $transactionId,
      "amount"         => $amount,
      "success_url"    => $successUrl,
      "hash"           => $hash,
    ];
    $queryString      = http_build_query($parameters);
    $payment_link_url = $this->paymentUrl . "?" . $queryString;

    return [
      'success'        => true,
      'payment_link'   => $payment_link_url,
      'transaction_id' => $transactionId,
      'amount'         => $amount,
      'parameters'     => $parameters,
    ];
  }

  /**
   * Verify payment status
   */
  public function verifyPayment(string $transactionId): array
  {
    try {
      $hash = $this->generateVerifyHash($transactionId);

      $data = [
        'transaction_id' => $transactionId,
        'hash'           => $hash,
      ];

      $response = Http::timeout(30)
        ->post($this->verifyUrl, $data);

      if (!$response->successful()) {
        throw new Exception("RaksmeypPay Verify API Error: " . $response->body());
      }

      $responseData = $response->json();

      // Log response for debugging (only in sandbox)
      if ($this->sandbox) {
        logger('RaksmeypPay Verify Response', [
          'transaction_id' => $transactionId,
          'response'       => $responseData,
        ]);
      }

      return [
        'success'        => true,
        'data'           => $responseData,
        'payment_status' => $responseData['payment_status'] ?? 'unknown',
        'payment_amount' => $responseData['payment_amount'] ?? 0
      ];

    } catch (Exception $e) {
      throw new Exception("Payment verification failed: " . $e->getMessage());
    }
  }

  /**
   * Validate payment data
   */
  private function validatePaymentData(array $data): void
  {
    $required = ['amount'];

    foreach ($required as $field) {
      if (!isset($data[$field]) || empty($data[$field])) {
        throw new Exception("Required field '{$field}' is missing or empty");
      }
    }

    if (!is_numeric($data['amount']) || $data['amount'] <= 0) {
      throw new Exception("Amount must be a positive number");
    }
  }

  /**
   * Check configuration
   */
  public function checkConfig(): array
  {
    $issues = [];

    if (empty($this->profileId)) {
      $issues[] = 'Profile ID is required';
    }

    if (empty($this->profileKey)) {
      $issues[] = 'Profile Key is required';
    }

    if (empty($this->paymentUrl)) {
      $issues[] = 'Payment URL is required';
    }

    if (empty($this->verifyUrl)) {
      $issues[] = 'Verify URL is required';
    }

    return [
      'status' => empty($issues) ? 'OK' : 'ERROR',
      'issues' => $issues,
      'config' => [
        'profile_id'  => $this->profileId,
        'payment_url' => $this->paymentUrl,
        'verify_url'  => $this->verifyUrl,
        'sandbox'     => $this->sandbox,
      ],
    ];
  }

  /**
   * Test connection to RaksmeypPay
   */
  public function testConnection(): array
  {
    // Check config first
    $configCheck = $this->checkConfig();
    if ($configCheck['status'] === 'ERROR') {
      return [
        'success'       => false,
        'message'       => 'Configuration errors: ' . implode(', ', $configCheck['issues']),
        'config_status' => $configCheck,
      ];
    }

    try {
      // Create test payment link
      $testData = [
        'transaction_id' => $this->generateTransactionId('TEST'),
        'amount'         => 1.00,
        'currency'       => 'USD',
        'success_url'    => config('app.url') . '/test'
      ];

      $result = $this->createPaymentLink($testData);

      return [
        'success'           => true,
        'message'           => 'Connection successful',
        'test_payment_link' => $result['payment_link'],
        'sandbox_mode'      => $this->sandbox,
        'config_status'     => $configCheck,
      ];

    } catch (Exception $e) {
      return [
        'success'       => false,
        'message'       => 'Connection failed: ' . $e->getMessage(),
        'sandbox_mode'  => $this->sandbox,
        'config_status' => $configCheck,
      ];
    }
  }

  /**
   * Debug hash generation
   */
  public function debugHashGeneration(array $testData): array
  {
    $transactionId = $testData['transaction_id'] ?? $this->generateTransactionId('DEBUG');
    $amount        = $this->formatAmount($testData['amount'] ?? 1.00);
    $successUrl    = $testData['success_url'] ?? config('app.url') . '/test';

    $dataString = $this->profileKey . $transactionId . $amount . $successUrl;
    $hash       = sha1($dataString);

    $verifyDataString = $this->profileKey . $transactionId;
    $verifyHash       = sha1($verifyDataString);

    return [
      'success'      => true,
      'payment_hash' => [
        'data_string' => $dataString,
        'hash'        => $hash,
        'components'  => [
          'profile_key'    => $this->profileKey,
          'transaction_id' => $transactionId,
          'amount'         => $amount,
          'success_url'    => $successUrl,
        ],
      ],
      'verify_hash'  => [
        'data_string' => $verifyDataString,
        'hash'        => $verifyHash,
        'components'  => [
          'profile_key'    => $this->profileKey,
          'transaction_id' => $transactionId,
        ],
      ],
    ];
  }
}
