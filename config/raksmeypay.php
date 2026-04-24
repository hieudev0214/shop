<?php

// NOTE: These configurations are now OVERRIDDEN by Admin Panel settings
// Go to Admin > Settings > APIs > RaksmeypPay to configure RaksmeypPay payment gateway
// This file serves as fallback values only

return [
  /*
  |--------------------------------------------------------------------------
  | RaksmeypPay Configuration
  |--------------------------------------------------------------------------
  |
  | Configuration cho RaksmeypPay payment gateway
  |
  */

  'base_url'      => env('RAKSMEYPAY_BASE_URL', 'https://raksmeypay.com'),

  'profile_id'    => env('RAKSMEYPAY_PROFILE_ID', ''),

  'profile_key'   => env('RAKSMEYPAY_PROFILE_KEY', ''),

  'sandbox'       => env('RAKSMEYPAY_SANDBOX', true),

  // Default currency
  'currency'      => env('RAKSMEYPAY_CURRENCY', 'USD'),

  // Timeout for API calls (seconds)
  'timeout'       => env('RAKSMEYPAY_TIMEOUT', 30),

  // Default URLs
  'success_url'   => env('RAKSMEYPAY_SUCCESS_URL'),
  'return_url'    => env('RAKSMEYPAY_RETURN_URL'),

  // Exchange rate (VND to USD)
  'exchange_rate' => env('RAKSMEYPAY_EXCHANGE_RATE', 26000),
];
