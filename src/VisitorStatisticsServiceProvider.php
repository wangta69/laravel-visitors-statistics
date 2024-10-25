<?php

namespace Pondol\VisitorsStatistics;


use Illuminate\Support\ServiceProvider;

class VisitorStatisticsProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register()
  {
    if ($this->app->runningInConsole()) {
      $this->commands([
        Console\InstallCommand::class,
      ]);
    }
  }

  /**
   * Bootstrap services.
   */
  public function boot()
  {

  }


}
