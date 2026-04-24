<?php

namespace App\Http\Controllers;

use App\Services\SystemMonitor;
use Illuminate\Http\JsonResponse;

class SystemMonitorController extends Controller
{
  protected $monitor;

  public function __construct(SystemMonitor $monitor)
  {
    $this->monitor = $monitor;
  }

  /**
   * Lấy thông tin hệ thống
   * GET /api/system-monitor
   */
  public function index(): JsonResponse
  {
    $data = $this->monitor->getSystemInfo();

    return response()->json($data);
  }

  /**
   * Clear cache (để reset baseline khi cần)
   * POST /api/system-monitor/clear-cache
   */
  public function clearCache(): JsonResponse
  {
    $result = $this->monitor->clearCache();

    return response()->json($result);
  }

  /**
   * Lấy chỉ CPU usage (lightweight endpoint)
   * GET /api/system-monitor/cpu
   */
  public function cpu(): JsonResponse
  {
    $data = $this->monitor->getSystemInfo();

    return response()->json([
      'cpu'       => $data['cpu'] ?? [],
      'timestamp' => $data['timestamp'],
    ]);
  }

  /**
   * Lấy chỉ memory info
   * GET /api/system-monitor/memory
   */
  public function memory(): JsonResponse
  {
    $data = $this->monitor->getSystemInfo();

    return response()->json([
      'memory'    => $data['memory'] ?? [],
      'timestamp' => $data['timestamp'],
    ]);
  }

  /**
   * Lấy chỉ disk I/O (cần gọi 2 lần)
   * GET /api/system-monitor/disk-io
   */
  public function diskIO(): JsonResponse
  {
    $data = $this->monitor->getSystemInfo();

    return response()->json([
      'diskIO'    => $data['diskIO'] ?? [],
      'timestamp' => $data['timestamp'],
    ]);
  }
}
