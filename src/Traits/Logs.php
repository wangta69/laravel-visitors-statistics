<?php

namespace Pondol\VisitorsStatistics\Traits;

use Pondol\VisitorsStatistics\Models\VisitorsLog;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


trait Logs
{


   /**
   * Get both all and unique statistics for a given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function _getLogs()
  {

    $logs = VisitorsLog();

    return $logs;
  }


}
