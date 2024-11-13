<?php

namespace Pondol\VisitorsStatistics;


use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;

use Pondol\VisitorsStatistics\Console\Commands\InstallCommand;
use Pondol\VisitorsStatistics\Console\Commands\UpdateMaxMindDatabase;
use Pondol\VisitorsStatistics\Console\Commands\ClearLogs;
use Pondol\VisitorsStatistics\GeoIP;
use Pondol\VisitorsStatistics\Http\Middleware\RecordVisits;
use Pondol\VisitorsStatistics\Visitor;
use DeviceDetector\DeviceDetector;


class VisitorStatisticsServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register()
  {

    // $this->app->bind(
    //   'Pondol\VisitorsStatistics\Contracts\Tracker',
    //   'Pondol\VisitorsStatistics\Tracker'
    // );

    $this->app->bind('Pondol\VisitorsStatistics\Contracts\Visitor', function ($app, $parameters) {
      return new Visitor($parameters['ipAddress'], $parameters['userAgent'], new DeviceDetector());
    });
    $this->app->bind('Pondol\VisitorsStatistics\Contracts\GeoIP', function ($app, $parameters) {
      return new GeoIP($parameters['ipAddress']);
    });

    if ($this->app->runningInConsole()) {
      
    }
  }

  /**
   * Bootstrap services.
   */
  public function boot()
  {
    // Register config
    $this->publishes([
      __DIR__ . '/config/pondol-visitor.php' => config_path('pondol-visitor.php'),
    ], 'config');
    $this->mergeConfigFrom(
      __DIR__ . '/config/pondol-visitor.php',
      'pondol-visitor'
    );

    // Register routes
    $this->loadVisitorsRoutes();

    // $this->publishes([
    //   __DIR__.'/resources/pondol/' => public_path('pondol')
    // ]);

    // Register migrations
    $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

    // Register commands and set task scheduling
    $this->commands([
      InstallCommand::class,
      UpdateMaxMindDatabase::class
    ]);
    
    $this->app->booted(function () {
      $schedule = app(Schedule::class);
      $schedule->command(UpdateMaxMindDatabase::class, ['scheduled' => true])->monthlyOn(12, '00:00');
      $schedule->command(ClearLogs::class, ['scheduled' => true])->daily();
    });

    // Register middleware and add it to 'web' group
    app('router')->pushMiddlewareToGroup('web', RecordVisits::class);
    $this->loadViewsFrom(__DIR__.'/resources/views', 'visitors');
  }
  /**
   * Define routes for getting statistics data.
   *
   * @return void
   */
  private function loadVisitorsRoutes()
  {
    $config = config('pondol-visitor.route_admin');

    Route::prefix($config['prefix'])
      ->as($config['as'])
      ->middleware($config['middleware'])
      ->namespace('Pondol\VisitorsStatistics\Http\Controllers\Admin')
      ->group(__DIR__ . '/routes/admin.php');

  
    $config = config('pondol-visitor.route');
    Route::prefix($config['prefix'])
      ->as($config['as'])
      ->middleware($config['middleware'])
      ->namespace('Pondol\VisitorsStatistics\Http\Controllers')
      ->group(__DIR__ . '/routes/web.php');
  }

}
