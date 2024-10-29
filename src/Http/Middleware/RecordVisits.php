<?php

namespace Pondol\VisitorsStatistics\Http\Middleware;

use Pondol\VisitorsStatistics\Tracker;
use Closure;
use Illuminate\Http\Request;

class RecordVisits
{
  /**
   * @var Tracker
   */
  private $tracker;

  /**
   * RecordVisits constructor.
   *
   * @param Tracker $tracker
   */
  public function __construct(Tracker $tracker)
  // public function __construct()
  {
    $this->tracker = $tracker;
  }

  /**
   * Handle an incoming request.
   *
   * @param Request $request
   * @param Closure $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $this->tracker->recordVisit();

    return $next($request);
  }
}
