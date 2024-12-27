<?php

namespace Pondol\VisitorsStatistics\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Pondol\VisitorsStatistics\Models\VisitorsLog;

use App\Http\Controllers\Controller;

class LogsController extends Controller
{

  public function log(Request $request) {
    $from_date = $request->from_date;
    $to_date = $request->to_date;
    // all, unique 방문자수 차트
    $logs = VisitorsLog::orderBy('id', 'desc');
    
    if ($from_date) {
      if (!$to_date) {
        $to_date = date("Y-m-d");
      }

      $startDate = Carbon::createFromFormat('Y-m-d', $from_date);
      $endDate = Carbon::createFromFormat('Y-m-d', $to_date);
      $logs = $logs->whereBetween("created_at", [$startDate->startOfDay(), $endDate->endOfDay()] );
    }
    
    $logs = $logs->paginate(10)->appends(request()->query());
    return view('visitors::admin.log', compact('logs'));
  }

}
