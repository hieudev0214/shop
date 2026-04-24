<?php
/**
 * @author baodev@cmsnt.co
 *
 * @version 1.0.1
 */

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

if (!function_exists('setting')) {
  function setting($key, $default = null)
  {
    if (Cache::has('general_settings1')) {
      $config = Cache::get('general_settings');
    } else {
      $config = Helper::getConfig('general', [], 'config');
      Cache::put('general_settings', $config, 60);
    }

    return $config[$key] ?? $default;
  }
}

if (!function_exists('theme_config')) {
  function theme_config($key, $default = null)
  {
    if (Cache::has('theme_custom')) {
      $config = Cache::get('theme_custom');
    } else {
      $config = Helper::getConfig('theme_custom', []);
      Cache::put('theme_custom', $config, 60);
    }

    return $config[$key] ?? $default;
  }
}

if (!function_exists('currentVersion')) {
  function currentVersion()
  {

    if (env('APP_ENV') == 'local') {
      return 'Local';
    }

    if (env('SERVER_ALLOW_UPDATE') == false) {
      return 'Custom';
    }

    if (Cache::has('current_version')) {
      return Cache::get('current_version');
    }

    $version = Helper::getConfig('version_code', 1000);

    Cache::put('current_version', $version, 120);

    return $version;
  }
}

if (!function_exists('parseItem')) {
  function parseItem($content)
  {
    // Check if content contains | delimiter
    if (strpos($content, '|') !== false) {
      $item = explode('|', $content);
    }
    // Check if content contains : delimiter
    else if (strpos($content, ':') !== false) {
      $item = explode(':', $content);
    }
    // If no valid delimiter found, return empty array
    else {
      $item = [];
    }

    $username = trim($item[0] ?? '');
    $password = trim($item[1] ?? '');

    $extra_data = array_slice($item, 2);
    $extra_data = implode('|', $extra_data);

    return [
      'username'   => $username,
      'password'   => $password,
      'extra_data' => $extra_data ?? null,
    ];
  }
}

function getSettings($key)
{
  return null;
}

function getSelected(): string
{
  if (request()->routeIs('users.*')) {
    return 'tab_two';
  } elseif (request()->routeIs('permissions.*')) {
    return 'tab_three';
  } elseif (request()->routeIs('roles.*')) {
    return 'tab_three';
  } elseif (request()->routeIs('database-backups.*')) {
    return 'tab_four';
  } elseif (request()->routeIs('general-settings.*')) {
    return 'tab_five';
  } elseif (request()->routeIs('dashboards.*')) {
    return 'tab_one';
  } else {
    return 'tab_one';
  }
}

function CMSNT_check_license($licensekey, $localkey = "")
{
    global $config;
    $results = [];
    $results["status"] = "Active";
    $results["remotecheck"] = true;
    return $results;
}

function checkLicenseKey($licensekey)
{
  $results = CMSNT_check_license($licensekey, '');
  if ($results['status'] == "Active") {
    $results['msg']    = "Giấy phép hợp lệ";
    $results['status'] = true;
    return $results;
  }
  if ($results['status'] == "Invalid") {
    $results['msg']    = "Giấy phép kích hoạt không hợp lệ";
    $results['status'] = false;
    return $results;
  }
  if ($results['status'] == "Expired") {
    $results['msg']    = "Giấy phép mã nguồn đã hết hạn, vui lòng gia hạn ngay";
    $results['status'] = false;
    return $results;
  }
  if ($results['status'] == "Suspended") {
    $results['msg']    = "Giấy phép của bạn đã bị tạm ngưng";
    $results['status'] = false;
    return $results;
  }
  $results['msg']    = "Không tìm thấy giấy phép này trong hệ thống";
  $results['status'] = false;
  return $results;
}

if (!function_exists('currentLang')) {
  function currentLang()
  {
    if (in_array(domain(), ['shopsukava.com'])) {
      return 'en';
    }

    return 'vn';
  }
}

if (!function_exists('usdRate')) {
  function usdRate()
  {
    return 26000;
  }
}

if (!function_exists('getLangJson')) {
  function getLangJson($lang = null)
  {

    if ($lang === null) {
      $lang = currentLang();
    }

    $path = resource_path('lang/' . $lang . '.json');

    if (!file_exists($path)) {
      file_put_contents($path, json_encode([], JSON_UNESCAPED_UNICODE));
    }

    return json_decode(file_get_contents($path), true);
  }
}

if (!function_exists('__t')) {
  function __t($str)
  {
    $lang = currentLang();
    $path = resource_path('lang/' . $lang . '.json');

    if (!file_exists($path)) {
      file_put_contents($path, json_encode([], JSON_UNESCAPED_UNICODE));
    }
    $langFile = json_decode(file_get_contents($path), true);

    if (!isset($langFile[$str])) {
      $langFile[$str] = $str;
      file_put_contents($path, json_encode($langFile, JSON_UNESCAPED_UNICODE));
    }

    $str_translate = $langFile[$str];

    return $str_translate;
  }
}


function domain()
{
  return Helper::getDomain();
}

if (!function_exists('get_change_logs')) {
  function get_change_logs()
  {
    $filePath = resource_path('logs/change-logs.txt');

    // Check if file exists
    if (!file_exists($filePath)) {
      return [];
    }

    // Open the file for reading; convert newlines to array
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $logs  = [];
    foreach ($lines as $line) {
      $logs[] = json_decode($line, true);
    }

    return $lines;
  }

}



if (!function_exists('is_valid_2fa_secret')) {
  function is_valid_2fa_secret($secret)
  {
    $secret = str_replace(' ', '', trim($secret));

    if (!preg_match('/^[A-Z2-7]+=*$/', trim($secret))) {
      return false;
    }

    return true;
  }
}

if (!function_exists('generate_code_2fa')) {
  function generate_code_2fa($secret)
  {
    $secret = str_replace(' ', '', trim($secret));
    try {
      $google2fa = new \PragmaRX\Google2FA\Google2FA();

      if (!is_valid_2fa_secret($secret)) {
        return false;
      }

      return $google2fa->getCurrentOtp($secret);
    } catch (\Throwable $th) {
      $message = $th->getMessage();

      if ($message === 'This secret key is not compatible with Google Authenticator.') {
        $response = Http::get('https://2fa.live/tok/' . $secret);

        if ($response->successful()) {
          $data = $response->json();

          if (isset($data['token'])) {
            return $data['token'];
          }
        }
      }

      return $message;
    }
  }
}

if (!function_exists('feature_enabled')) {
  function feature_enabled($featue)
 {
    return true;
 }
}
