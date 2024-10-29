<?php

namespace Pondol\VisitorsStatistics;


use Illuminate\Support\ServiceProvider;

use Pondol\VisitorsStatistics\Console\Commands\InstallCommand;
use Pondol\VisitorsStatistics\Console\Commands\UpdateMaxMindDatabase;
use Pondol\VisitorsStatistics\GeoIP;
use Pondol\VisitorsStatistics\Http\Middleware\RecordVisits;
use Pondol\VisitorsStatistics\Visitor;
use DeviceDetector\DeviceDetector;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;

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
      __DIR__ . '/config/visitorstatistics.php' => config_path('visitorstatistics.php'),
    ], 'config');
    $this->mergeConfigFrom(
      __DIR__ . '/config/visitorstatistics.php',
      'visitorstatistics'
    );

    // Register routes
    $this->mapStatisticsRoutes();

    // Register migrations
    $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

    // Register commands and set task scheduling
    $this->commands([
      InstallCommand::class,
      UpdateMaxMindDatabase::class
    ]);
    
    $this->app->booted(function () {
        // Since maxmind database is updated every first Thursday of the month
        // day 12 of each month is guaranteed to be on or after first Thursday
        $schedule = app(Schedule::class);
        $schedule->command(UpdateMaxMindDatabase::class, ['scheduled' => true])->monthlyOn(12, '00:00');
    });

    // Register middleware and add it to 'web' group
    app('router')->pushMiddlewareToGroup('web', RecordVisits::class);
  }
  /**
   * Define routes for getting statistics data.
   *
   * @return void
   */
  private function mapStatisticsRoutes()
  {
    $config = config('visitorstatistics');

    Route::prefix($config['prefix'])
      ->middleware($config['middleware'])
      ->namespace('Pondol\VisitorsStatistics\Http\Controllers')
      ->group(__DIR__ . '/routes/web.php');
  }

}
