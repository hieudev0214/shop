<?php

namespace App\Providers;

use App\Services\SystemMonitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton(SystemMonitor::class, function ($app) {
      return new SystemMonitor();
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    if ($this->app->environment('production')) {
      URL::forceScheme('https');
      // Model::shouldBeStrict(true);
    }

    // paginate bootstrap 5
    // if (method_exists(\Illuminate\Pagination\AbstractPaginator::class, 'useBootstrap')) {
    //   \Illuminate\Pagination\AbstractPaginator::useBootstrap();
    // }

    Paginator::useBootstrapFour();

  }
}
