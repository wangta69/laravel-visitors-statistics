<?php

namespace Pondol\VisitorsStatistics\Console;

use Illuminate\Console\Command;
// use Illuminate\Filesystem\Filesystem;
// use Illuminate\Support\Str;
// use Symfony\Component\Process\PhpExecutableFinder;
// use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
  // use InstallsBladeStack;

  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'pondol:install-visitor-statistics {type=full}'; // full | only

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install the Laravel Visitor Statistics Tracker';


  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $type = $this->argument('type');
  }




}
