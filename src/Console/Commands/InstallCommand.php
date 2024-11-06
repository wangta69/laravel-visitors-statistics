<?php

namespace Pondol\VisitorsStatistics\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
  // use InstallsBladeStack;

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'pondol:install-visitors {type=full}'; // full | only

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install the Laravel Visitor Statistics Tracker.';


  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $type = $this->argument('type');
    $this->installLaravelVisitors($type);
  }

  private function installLaravelVisitors($type) {
    \Artisan::call('vendor:publish',  [
      '--force'=> true,
      '--provider' => 'Pondol\VisitorsStatistics\VisitorStatisticsServiceProvider'
    ]);
    
    \Artisan::call('migrate');
    // copy GeoLite2-City.mmdb
    $storage_path = config('pondol-visitor.storage_path');
    (new Filesystem)->ensureDirectoryExists($storage_path);
    copy(__DIR__.'/../../resources/GeoLite2-City.mmdb', $storage_path.'/GeoLite2-City.mmdb');
  }

}
