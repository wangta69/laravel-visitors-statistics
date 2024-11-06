<?php

namespace Pondol\VisitorsStatistics\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;

use Pondol\VisitorsStatistics\VisitorStatisticsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
  
    /**
     * @inheritDoc
     */
    protected function getPackageProviders($app)
    {
      return [VisitorStatisticsServiceProvider::class];
    }


    protected function getEnvironmentSetUp($app)
    {

      $app->useEnvironmentPath(__DIR__.'/../../../../..');
      $app->bootstrapWith([LoadEnvironmentVariables::class]);

      // parent::getEnvironmentSetUp($app);

      $app['config']->set('database.connections.mysql', [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'unix_socket' => env('DB_SOCKET', ''),
      ]);
    }
}
