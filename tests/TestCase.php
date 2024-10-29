<?php

namespace Pondol\VisitorsStatistics\Tests;

use Pondol\VisitorsStatistics\VisitorStatisticsProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
  /**
   * @inheritDoc
   */
  protected function getPackageProviders($app)
  {
    return [VisitorStatisticsProvider::class];
  }
}
