<?php

namespace App\View\Composers;

use Helper;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class TopbarMenuComposer
{
  public function compose(View $view): void
  {
    try {
      $menuData = $this->getMenuData();
    } catch (\Exception $e) {
      // Fallback to default values if cache or config fails
      $menuData = $this->getDefaultMenuData();
    }

    $view->with('menuData', $menuData);
  }

  private function getMenuData(): array
  {
    return Cache::remember('topbar_menu_data', 300, function () {
      return [
        'depositPorts' => $this->getDepositPorts(),
        'authGoogle'   => $this->getAuthGoogleConfig(),
        'features'     => $this->getFeatures(),
      ];
    });
  }

  private function getDepositPorts(): array
  {
    $config = Helper::getConfig('deposit_port', []);

    return [
      'card'          => $config['bank'] ?? false,
      'invoice'       => $config['invoice'] ?? false,
      'banking'       => $config['bank'] ?? false,
      'paypal'        => $config['paypal'] ?? false,
      'raksmeypay'    => $config['raksmeypay'] ?? false,
      'crypto'        => $config['crypto'] ?? false,
      'perfect_money' => $config['perfect_money'] ?? false,
    ];
  }

  private function getAuthGoogleConfig(): array
  {
    $config = Helper::getApiConfig('auth_google', []);

    return [
      'enabled' => isset($config['client_status']) && $config['client_status'],
    ];
  }

  private function getFeatures(): array
  {
    return [
      'bulk_orders' => feature_enabled('bulk-orders'),
    ];
  }

  private function getDefaultMenuData(): array
  {
    return [
      'depositPorts' => [
        'card'          => false,
        'invoice'       => false,
        'banking'       => false,
        'paypal'        => false,
        'raksmeypay'    => false,
        'crypto'        => false,
        'perfect_money' => false,
      ],
      'authGoogle'   => [
        'enabled' => false,
      ],
      'features'     => [
        'bulk_orders' => false,
      ],
    ];
  }
}
