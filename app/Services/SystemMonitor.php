<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

/**
 * System Monitor for Laravel 12
 * Tối ưu cho VPS Linux & cPanel Hosting
 * Sử dụng Cache để lưu baseline cho Disk I/O
 */
class SystemMonitor
{
  private $isCPanel = false;
  private $hasShellExec = false;
  private $isLinux = false;
  private $cacheDriver = 'file'; // 'redis', 'file', 'memcached'

  public function __construct()
  {
    $this->hasShellExec = function_exists('shell_exec') &&
      !in_array('shell_exec', array_map('trim', explode(',', ini_get('disable_functions'))));
    $this->isLinux      = PHP_OS_FAMILY === 'Linux';

    // Detect cPanel
    $this->isCPanel = file_exists('/usr/local/cpanel/version') ||
      file_exists('/var/cpanel/version') ||
      getenv('CPANEL') !== false;

    // Auto-detect cache driver
    $this->cacheDriver = config('cache.default', 'file');
  }

  public function getSystemInfo()
  {
    $info = [
      'environment'  => $this->detectEnvironment(),
      'timestamp'    => now()->toDateTimeString(),
      'cache_driver' => $this->cacheDriver,
    ];

    $info['disk']      = $this->getDiskInfo();
    $info['cpu']       = $this->getCPUInfo();
    $info['memory']    = $this->getMemoryInfo();
    $info['diskIO']    = $this->getDiskIO();
    $info['processes'] = $this->getProcessInfo();
    $info['php']       = $this->getPHPInfo();
    $info['health']    = $this->analyzeHealth($info);

    return $info;
  }

  private function detectEnvironment()
  {
    if ($this->isCPanel) {
      return 'cPanel Shared Hosting';
    } elseif ($this->hasShellExec) {
      return 'VPS/Dedicated Linux';
    } else {
      return 'Restricted Environment';
    }
  }

  private function getDiskInfo()
  {
    $path = $this->isCPanel ? base_path() : '/';

    $free  = @disk_free_space($path);
    $total = @disk_total_space($path);

    if ($free === false || $total === false) {
      return ['error' => 'Cannot read disk space'];
    }

    $used = $total - $free;

    return [
      'path'        => $path,
      'freeGB'      => round($free / (1024 ** 3), 2),
      'usedGB'      => round($used / (1024 ** 3), 2),
      'totalGB'     => round($total / (1024 ** 3), 2),
      'usedPercent' => round(($used / $total) * 100, 2),
    ];
  }

  private function getCPUInfo()
  {
    $cpu = [];

    // Load average
    if (function_exists('sys_getloadavg')) {
      $load           = sys_getloadavg();
      $cpu['loadAvg'] = [
        '1min'  => round($load[0], 2),
        '5min'  => round($load[1], 2),
        '15min' => round($load[2], 2),
      ];
    }

    // CPU info from /proc/cpuinfo
    if ($this->isLinux && is_readable('/proc/cpuinfo')) {
      $cpuinfo = @file_get_contents('/proc/cpuinfo');
      if ($cpuinfo) {
        preg_match_all('/^processor/m', $cpuinfo, $matches);
        $cpu['cores'] = count($matches[0]);

        preg_match('/model name\s*:\s*(.+)/m', $cpuinfo, $model);
        $cpu['model'] = trim($model[1] ?? 'Unknown');
      }
    }

    // Real-time CPU usage from /proc/stat
    if (is_readable('/proc/stat')) {
      $usage = $this->calculateCPUUsageFromStat();
      if ($usage !== null) {
        $cpu['usage'] = $usage;
      }
    }

    return $cpu ?: ['error' => 'No CPU info available'];
  }

  private function calculateCPUUsageFromStat()
  {
    $cacheKey  = 'system_monitor_cpu_stat';
    $lastStats = Cache::get($cacheKey);

    $stat = @file_get_contents('/proc/stat');
    if (!$stat)
      return null;

    preg_match('/^cpu\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/m', $stat, $matches);
    if (!$matches)
      return null;

    $user   = $matches[1];
    $nice   = $matches[2];
    $system = $matches[3];
    $idle   = $matches[4];
    $iowait = $matches[5];

    $total        = $user + $nice + $system + $idle + $iowait;
    $currentStats = [
      'total' => $total,
      'idle'  => $idle,
      'time'  => microtime(true),
    ];

    if ($lastStats !== null) {
      $totalDiff = $currentStats['total'] - $lastStats['total'];
      $idleDiff  = $currentStats['idle'] - $lastStats['idle'];

      if ($totalDiff > 0) {
        $usage = 100 * (1 - $idleDiff / $totalDiff);

        // Cache cho lần sau (TTL 10 giây)
        Cache::put($cacheKey, $currentStats, 10);

        return round($usage, 2);
      }
    }

    // Lần đầu: lưu baseline
    Cache::put($cacheKey, $currentStats, 10);
    return null;
  }

  private function getMemoryInfo()
  {
    $memory = [];

    // PHP memory
    $memory['php'] = [
      'usedMB'  => round(memory_get_usage(true) / (1024 ** 2), 2),
      'peakMB'  => round(memory_get_peak_usage(true) / (1024 ** 2), 2),
      'limitMB' => ini_get('memory_limit'),
    ];

    // System memory from /proc/meminfo
    if (is_readable('/proc/meminfo')) {
      $meminfo = @file_get_contents('/proc/meminfo');
      if ($meminfo) {
        preg_match('/MemTotal:\s+(\d+)/', $meminfo, $total);
        preg_match('/MemAvailable:\s+(\d+)/', $meminfo, $available);

        if ($total && $available) {
          $totalKB     = (int) $total[1];
          $availableKB = (int) $available[1];
          $usedKB      = $totalKB - $availableKB;

          $memory['system'] = [
            'totalMB'     => round($totalKB / 1024, 2),
            'usedMB'      => round($usedKB / 1024, 2),
            'availableMB' => round($availableKB / 1024, 2),
            'usedPercent' => round(($usedKB / $totalKB) * 100, 2),
          ];
        }
      }
    }

    return $memory;
  }

  private function getDiskIO()
  {
    // Chỉ work trên VPS/Linux với quyền đọc /proc/diskstats
    if (!is_readable('/proc/diskstats')) {
      return ['error' => 'No permission (shared hosting limitation)'];
    }

    $cacheKey = 'system_monitor_diskio';
    $lastData = Cache::get($cacheKey);

    $diskstats = @file('/proc/diskstats', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$diskstats) {
      return ['error' => 'Cannot read /proc/diskstats'];
    }

    $currentStats = [];
    $currentTime  = microtime(true);

    foreach ($diskstats as $line) {
      $parts = preg_split('/\s+/', trim($line));

      // Chỉ lấy main devices
      if (count($parts) >= 14 && preg_match('/^(sd[a-z]|nvme\d+n\d+|vd[a-z])$/', $parts[2])) {
        $device                = $parts[2];
        $currentStats[$device] = [
          'reads'        => (int) $parts[3],
          'readSectors'  => (int) $parts[5],
          'writes'       => (int) $parts[7],
          'writeSectors' => (int) $parts[9]
        ];
      }
    }

    // Nếu có data cũ, tính rate
    if ($lastData !== null && isset($lastData['stats'], $lastData['time'])) {
      $timeDiff = $currentTime - $lastData['time'];

      // Chỉ tính nếu khoảng cách > 0.5s để tránh division by zero
      if ($timeDiff >= 0.5) {
        $io = [];

        foreach ($currentStats as $device => $stats) {
          if (isset($lastData['stats'][$device])) {
            $lastStats = $lastData['stats'][$device];

            $readSectorsDiff  = $stats['readSectors'] - $lastStats['readSectors'];
            $writeSectorsDiff = $stats['writeSectors'] - $lastStats['writeSectors'];

            // 1 sector = 512 bytes
            $io[$device] = [
              'read_kBps'  => round(($readSectorsDiff * 512 / 1024) / $timeDiff, 2),
              'write_kBps' => round(($writeSectorsDiff * 512 / 1024) / $timeDiff, 2),
              'total_kBps' => round((($readSectorsDiff + $writeSectorsDiff) * 512 / 1024) / $timeDiff, 2),
            ];
          }
        }

        // Cache data mới (TTL 10 giây)
        Cache::put($cacheKey, [
          'stats' => $currentStats,
          'time'  => $currentTime,
        ], 10);

        return $io ?: ['note' => 'No disk activity detected'];
      }
    }

    // Lần đầu hoặc quá gần: lưu baseline
    Cache::put($cacheKey, [
      'stats' => $currentStats,
      'time'  => $currentTime,
    ], 10);

    return [
      'note'      => 'Collecting baseline... Reload page in 1-2 seconds',
      'cached_at' => now()->toDateTimeString(),
    ];
  }

  private function getProcessInfo()
  {
    $process = [];

    if (function_exists('getmypid')) {
      $process['php_pid'] = getmypid();
    }

    if (function_exists('getmyuid')) {
      $process['php_uid'] = getmyuid();
    }

    return $process;
  }

  private function getPHPInfo()
  {
    $php = [];

    // PHP Version & SAPI
    $php['version'] = PHP_VERSION;
    $php['sapi']    = php_sapi_name();

    // PHP Configuration
    $php['config'] = [
      'max_execution_time'  => ini_get('max_execution_time') . 's',
      'post_max_size'       => ini_get('post_max_size'),
      'upload_max_filesize' => ini_get('upload_max_filesize'),
      'memory_limit'        => ini_get('memory_limit'),
      'display_errors'      => ini_get('display_errors') ? 'On' : 'Off',
    ];

    // Loaded Extensions
    $loadedExtensions  = get_loaded_extensions();
    $php['extensions'] = [
      'count'     => count($loadedExtensions),
      'important' => array_values(array_filter($loadedExtensions, function ($ext) {
        // Chỉ lấy các extensions quan trọng
        return in_array(strtolower($ext), [
          'curl',
          'gd',
          'mbstring',
          'pdo',
          'mysqli',
          'zip',
          'openssl',
          'json',
          'xml',
          'redis',
          'memcached',
          'opcache',
          'imagick',
          'sodium',
          'bcmath',
          'intl',
        ]);
      })),
      'all'       => $loadedExtensions,
    ];

    // OPcache Status
    if (function_exists('opcache_get_status')) {
      $opcacheStatus = @opcache_get_status();
      if ($opcacheStatus !== false) {
        $php['opcache'] = [
          'enabled'         => $opcacheStatus['opcache_enabled'] ?? false,
          'cache_full'      => $opcacheStatus['cache_full'] ?? false,
          'scripts_cached'  => $opcacheStatus['opcache_statistics']['num_cached_scripts'] ?? 0,
          'hits'            => $opcacheStatus['opcache_statistics']['hits'] ?? 0,
          'misses'          => $opcacheStatus['opcache_statistics']['misses'] ?? 0,
          'memory_usage_mb' => isset($opcacheStatus['memory_usage']['used_memory'])
            ? round($opcacheStatus['memory_usage']['used_memory'] / (1024 ** 2), 2)
            : 0
        ];
      }
    }

    // Zend Engine
    $php['zend_version'] = zend_version();

    return $php;
  }

  public function analyzeHealth($info)
  {
    $health = [
      'status'          => 'healthy',
      'score'           => 100,
      'alerts'          => [],
      'recommendations' => [],
    ];

    // Check CPU Load
    if (isset($info['cpu']['loadAvg'], $info['cpu']['cores'])) {
      $cores       = max($info['cpu']['cores'], 1);
      $load1min    = $info['cpu']['loadAvg']['1min'];
      $loadPerCore = $load1min / $cores;

      if ($loadPerCore > 2) {
        $health['alerts'][]          = "🔴 CRITICAL: CPU overload " . round($loadPerCore, 2) . "x (load: {$load1min} on {$cores} core)";
        $health['recommendations'][] = "Kiểm tra processes đang chạy, tìm script nặng, optimize queries";
        $health['score'] -= 40;
        $health['status']            = 'critical';
      } elseif ($loadPerCore > 1) {
        $health['alerts'][]          = "🟡 WARNING: CPU high load " . round($loadPerCore, 2) . "x";
        $health['recommendations'][] = "CPU đang làm việc 100%, cân nhắc giảm tải";
        $health['score'] -= 20;
        if ($health['status'] === 'healthy')
          $health['status'] = 'warning';
      }
    }

    // Check Memory
    if (isset($info['memory']['system']['usedPercent'])) {
      $memUsed = $info['memory']['system']['usedPercent'];

      if ($memUsed > 90) {
        $health['alerts'][]          = "🔴 CRITICAL: RAM usage {$memUsed}% - sắp hết bộ nhớ!";
        $health['recommendations'][] = "Kill processes không cần thiết, enable swap";
        $health['score'] -= 30;
        $health['status']            = 'critical';
      } elseif ($memUsed > 80) {
        $health['alerts'][]          = "🟡 WARNING: RAM usage {$memUsed}% - cao";
        $health['recommendations'][] = "Monitor memory leaks, xem xét tăng RAM";
        $health['score'] -= 15;
        if ($health['status'] === 'healthy')
          $health['status'] = 'warning';
      }
    }

    // Check Disk Space
    if (isset($info['disk']['usedPercent'])) {
      $diskUsed = $info['disk']['usedPercent'];

      if ($diskUsed > 90) {
        $health['alerts'][]          = "🔴 CRITICAL: Disk {$diskUsed}% full!";
        $health['recommendations'][] = "Dọn logs, cache, backup cũ ngay";
        $health['score'] -= 25;
        $health['status']            = 'critical';
      } elseif ($diskUsed > 80) {
        $health['alerts'][]          = "🟡 WARNING: Disk {$diskUsed}% full";
        $health['recommendations'][] = "Chuẩn bị dọn dẹp disk";
        $health['score'] -= 10;
        if ($health['status'] === 'healthy')
          $health['status'] = 'warning';
      }
    }

    // Load trend
    if (isset($info['cpu']['loadAvg'])) {
      $load1  = $info['cpu']['loadAvg']['1min'];
      $load5  = $info['cpu']['loadAvg']['5min'];
      $load15 = $info['cpu']['loadAvg']['15min'];

      if ($load1 > $load5 && $load5 > $load15) {
        $health['alerts'][] = "📈 Load đang TĂNG - cần theo dõi";
      } elseif ($load1 < $load5 && $load5 < $load15) {
        $health['alerts'][] = "📉 Load đang giảm - hệ thống ổn định";
      }
    }

    if ($health['score'] >= 80 && empty($health['alerts'])) {
      $health['alerts'][] = "✅ Hệ thống hoạt động tốt";
    }

    $health['score'] = max(0, $health['score']);

    return $health;
  }

  /**
   * Clear cache để reset baseline (hữu ích khi debug)
   */
  public function clearCache()
  {
    Cache::forget('system_monitor_cpu_stat');
    Cache::forget('system_monitor_diskio');

    return ['message' => 'Cache cleared successfully'];
  }
}
