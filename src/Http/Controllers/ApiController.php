<?php

namespace Pondol\VisitorsStatistics\Http\Controllers;

use Illuminate\Http\JsonResponse;

use Pondol\VisitorsStatistics\Traits\Statistics as t_Statistics;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

  use t_Statistics;
  /**
   * Get statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function getStatistics(int $year, ?int $month = null): JsonResponse
  {
    return response()->json($this->_getStatistics($year, $month));
  }

  /**
   * Get unique statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function getUniqueStatistics(int $year, ?int $month = null): JsonResponse
  {
    return response()->json($this->_getUniqueStatistics($year, $month));
  }

  /**
   * Get both all and unique statistics for a given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function getTotalStatistics(int $year, ?int $month = null): JsonResponse
  {
    return response()->json($this->_getTotalStatistics($year, $month));
  }

  /**
   * Get visits count and percentage for each country.
   *
   * @return JsonResponse
   */
  public function getCountriesStatistics(): JsonResponse
  {
    return response()->json($this->_getCountriesStatistics());
  }

  /**
   * Get years or months that have statistics tracked.
   *
   * @param int|null $year
   *
   * @return JsonResponse
   */
  public function getAvailableDates(?int $year = null): JsonResponse
  {
    return response()->json($this->_getAvailableDates($year));
  }
}
