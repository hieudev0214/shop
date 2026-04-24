<?php

namespace App\Providers;

use App\Services\RaksmeypPayService;
use Illuminate\Support\ServiceProvider;

class RaksmeypPayServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    $this->app->singleton(RaksmeypPayService::class, function ($app) {
      return new RaksmeypPayService();
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
