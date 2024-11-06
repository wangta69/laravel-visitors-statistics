<?php

namespace Pondol\VisitorsStatistics;

use Pondol\VisitorsStatistics\Contracts\Tracker as TrackerContract;
use Pondol\VisitorsStatistics\Contracts\Visitor as VisitorContact;
use Pondol\VisitorsStatistics\Models\VisitorsStatistic;
use Pondol\VisitorsStatistics\Models\Visitor;
use Pondol\VisitorsStatistics\Models\VisitorsLog;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;

class Tracker implements TrackerContract
{
  /**
   * @var Visitor
   */
  private $visitor;

  /**
   * @var Request
   */
  private $request;

  /**
   * @var CarbonInterface|static
   */
  private $today;

  /**
   * Tracker constructor.
   *
   * @param Request $request
   */
  public function __construct(Request $request)
  {


    // // $this->request = $request;
    // https://laravel.com/docs/11.x/helpers#method-resolve
    $this->visitor = resolve(VisitorContact::class, [
      // 'ipAddress' => $request->header('HTTP_CF_CONNECTING_IP') ?? $request->getClientIp(),
      'ipAddress' => $this->getRealIpAddr(),
      'userAgent' => $request->userAgent()
    ]);

    // $this->visitor = VisitorContact::class;
    // $this->visitor->ipAddress = $request->header('HTTP_CF_CONNECTING_IP') ?? $request->getClientIp();

    $this->today = Carbon::today();
  }

  /**
   * Save visitor information in the database.
   */
  public function recordVisit()
  {
    if ($this->shouldTrackUser()) {
      $visitorInformation = $this->getVisitorInformation();
      $isNewVisitor = $this->storeVisitor($visitorInformation);
      $this->storeVisitorlogs($visitorInformation);
      $this->updateAllStatistics();

      if ($isNewVisitor) {
        $this->updateUniqueStatistics();
      }
    }
  }

  /**
   * Check if the visitor should be tracked.
   *
   * @return bool
   */
  public function shouldTrackUser(): bool
  {

    if ( $this->visitor->isBot()) {
      return false;
    }

    // if ((config('pondol-visitor.track_authenticated_users') === false && !is_null(auth()->user())) ||
    //   (config('pondol-visitor.track_ajax_request') === false && request()->ajax()) ||
    //   $this->request->is(config('pondol-visitor.login_route_path')) ||
    //   $this->visitor->isBot()) {
    //   return false;
    // }

    return true;
  }

  /**
   * Gather visitor information.
   *
   * @return array
   */
  public function getVisitorInformation(): array
  {
    return [
      'ip' => $this->visitor->getIp(),
      'continent' => $this->visitor->getContinent(),
      'country' => $this->visitor->getCountry(),
      'city' => $this->visitor->getCity(),
      'device' => $this->visitor->getDevice(),
      'browser' => $this->visitor->getBrowser(),
    ];
  }

  /**
   * Save visitor information in database.
   *
   * @param array $visitorInformation
   *
   * @return bool True if new visitor, false if existing
   */
  private function storeVisitor(array $visitorInformation): bool
  {
    $hasVisitedToday = Visitor::where('ip', $visitorInformation['ip'])
      ->whereBetween('created_at', [$this->today, $this->today->copy()->endOfDay()])
      ->first();

    if ($hasVisitedToday) {
      $hasVisitedToday->touch();
      return false;
    }

    Visitor::create($visitorInformation);

    return true;
  }

  private function storeVisitorlogs(array $visitorInformation): bool {
    $visitorInformation['user_id'] = \Auth::id();
    VisitorsLog::create($visitorInformation);

    return true;
  }

  

  /**
   * Update statistics in the database.
   */
  private function updateAllStatistics(): void
  {
    $statistic = VisitorsStatistic::firstOrNew([
      'date' => $this->today->format('Y-m-d'),
      'type' => VisitorsStatistic::TYPES['all'],
    ]);
    $statistic->value++;
    $statistic->save();
  }

  /**
   * Update unique statistics in the database.
   */
  private function updateUniqueStatistics(): void
  {
    $statistic = VisitorsStatistic::firstOrNew([
      'date' => $this->today->format('Y-m-d'),
      'type' => VisitorsStatistic::TYPES['unique'],
    ]);
    $statistic->value++;
    $statistic->save();
  }


  private function getRealIpAddr(){
    // ipAddress' => $request->header('HTTP_CF_CONNECTING_IP') ?? $request->getClientIp(),
    if(!empty($_SERVER['HTTP_CLIENT_IP']) && getenv('HTTP_CLIENT_IP')){
      return $_SERVER['HTTP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && getenv('HTTP_X_FORWARDED_FOR')){
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else if(!empty($_SERVER['REMOTE_HOST']) && getenv('REMOTE_HOST')){
      return $_SERVER['REMOTE_HOST'];
    }else if(!empty($_SERVER['REMOTE_ADDR']) && getenv('REMOTE_ADDR')){
      return $_SERVER['REMOTE_ADDR'];
    }
    return false;
  }
}
