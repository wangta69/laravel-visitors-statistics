<?php

namespace Pondol\VisitorsStatistics\Console\Commands;
use Illuminate\Console\Command;
use Carbon\Carbon;

use Pondol\VisitorsStatistics\Models\VisitorsLog;

class ClearLogs extends Command

{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'pondol:visitors-log-cleare {--scheduled}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Cleare visitors logs from table.';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
      parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @throws Exception
   *
   * @return mixed
   */
  public function handle()
  {
    $this->logsClear();
  }

  private function logsClear() {
    ClearLogs::where('created_at', '<',  Carbon::now()->subDays(config('pondol-visitor.visitors_logs_retention_period'))->startOfDay())->delete();
  }
}
