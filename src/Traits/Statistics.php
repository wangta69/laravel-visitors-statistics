<?php

namespace Pondol\VisitorsStatistics\Traits;

use Pondol\VisitorsStatistics\Models\Visitor;
use Pondol\VisitorsStatistics\Models\VisitorsStatistic;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


trait Statistics
{
  /**
   * Get statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function _getStatistics(int $year, ?int $month = null) 
  {
    return [
      'data' => $this->retrieveStatistics(VisitorsStatistic::TYPES['all'], $year, $month),
    ];
  }

  /**
   * Get unique statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function _getUniqueStatistics(int $year, ?int $month = null)
  {
    return [
      'data' => $this->retrieveStatistics(VisitorsStatistic::TYPES['unique'], $year, $month),
    ];
  }

  /**
   * Get both all and unique statistics for a given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function _getTotalStatistics(int $year, ?int $month = null)
  {
    return [
      'all' => $this->retrieveStatistics(VisitorsStatistic::TYPES['all'], $year, $month),
      'unique' => $this->retrieveStatistics(VisitorsStatistic::TYPES['unique'], $year, $month),
    ];
  }

  /**
   * Get visits count and percentage for each country.
   *
   * @return JsonResponse
   */
  public function _getCountriesStatistics()
  {
    $visitors = Visitor::getVisitorCountPerCountry();
    $visitorCount = Visitor::count();

    foreach ($visitors as $visitor) {
      $visitor->percentage = round($visitor->count * 100 / $visitorCount, 2);
    }
    return $visitors->toArray();
  }

  /**
   * Get devices count 
   */
  public function _getDeviceStatistics()
  {
    $visitors = Visitor::getDeviceCount();
    $visitorCount = Visitor::count();

    foreach ($visitors as $visitor) {
      $visitor->percentage = round($visitor->count * 100 / $visitorCount, 2);
    }
    return $visitors->toArray();
  }

   /**
   * Get browsers count
   */
  public function _getBrowserStatistics()
  {
    $visitors = Visitor::getBrowserCount();
    $visitorCount = Visitor::count();

    foreach ($visitors as $visitor) {
      $visitor->percentage = round($visitor->count * 100 / $visitorCount, 2);
    }
    return $visitors->toArray();
  }

  /**
   * Get years or months that have statistics tracked.
   *
   * @param int|null $year
   *
   * @return JsonResponse
   */
  public function _getAvailableDates(?int $year = null)
  {
    $result = [];

    if (is_null($year)) {
      $min = VisitorsStatistic::min('created_at');
      $max = VisitorsStatistic::max('created_at');

      if (!is_null($min)) {
        $startYear = Carbon::createFromTimeString($min)->year;
        $endYear = Carbon::createFromTimeString($max)->year;

        for ($i = $startYear; $i <= $endYear; $i++) {
          $result[] = $i;
        }

        if ($startYear !== $endYear) {
          $result[] = $endYear;
        }
      }
    } else {
      $startDate = Carbon::createFromDate($year, 1, 1);
      $endDate = Carbon::createFromDate($year, 12, 31);

      $min = VisitorsStatistic::whereBetween('created_at', [$startDate, $endDate])->min('created_at');
      $max = VisitorsStatistic::whereBetween('created_at', [$startDate, $endDate])->max('created_at');

      if (!is_null($min)) {
        $startMonth = Carbon::createFromTimeString($min)->month;
        $endMonth = Carbon::createFromTimeString($max)->month;

        for ($i = $startMonth; $i <= $endMonth; $i++) {
          $result[] = $i;
        }
      }
    }

    return [
      'data' => $result
    ];
  }

  /**
   * Retrieve statistics for given year or month and type.
   *
   * @param string $type
   * @param int $year
   * @param int|null $month
   *
   * @return array
   */
  private function retrieveStatistics(string $type, int $year, ?int $month = null): array
  {
    if (is_null($month)) {
      $startDate = Carbon::createFromDate($year, 1, 1)->startOfDay();
      $endDate = $startDate->copy()->endOfYear();
    } else {
      $startDate = Carbon::createFromDate($year, $month, 1)->startOfDay();
      $endDate = $startDate->copy()->endOfMonth();
    }

    $data = [];
    $statistics = VisitorsStatistic::select(['value', 'created_at'])
      ->whereBetween('created_at', [$startDate, $endDate])
      ->where('type', $type)
      ->get();

    if (is_null($month)) {
      for ($i = 1; $i <= 12; $i++) {
        $data[$i] = 0;
      }

      foreach ($statistics as $statistic) {
        $data[Carbon::createFromTimeString($statistic->created_at)->month] += $statistic->value;
      }
    } else {
      for ($i = 1; $i <= Carbon::createFromDate($year, $month, 1)->endOfMonth()->day; $i++) {
        $data[$i] = 0;
      }

      foreach ($statistics as $statistic) {
        $data[Carbon::createFromTimeString($statistic->created_at)->day] += $statistic->value;
      }
    }

    return $data;
  }
}
