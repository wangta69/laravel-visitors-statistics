<?php

namespace Pondol\VisitorsStatistics\Http\Controllers;
use Carbon\Carbon;

use Pondol\VisitorsStatistics\Traits\Statistics as t_Statistics;
use Pondol\Charts\Facades\Chartjs;

use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{

  use t_Statistics;

  public function dashboard() {
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $data = $this->_getTotalStatistics($year, $month);

    $chart = Chartjs::
    type('line')
    ->element('dailyChart')
    ->labels(array_keys($data['all']))
    ->datasets([
      [
        'label' => '# all',
        'data' => array_values($data['all']),
        'borderWidth' => 1
      ],
      [
        'label' => '# unique',
        'data' => array_values($data['unique']),
        'borderWidth' => 1
      ]
    ])
    ->options(['title'=>['text'=>'ryu....']])->render();

    return view('visitors::admin.dashboard', compact('chart'));
  }
  /**
   * Get statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function getStatistics(int $year, ?int $month = null)
  {
    print_r($this->_getTotalStatistics($year, $month));
    return view('visitors::admin.dashboard', $this->_getStatistics($year, $month));
  }

  /**
   * Get unique statistics for the given year or month.
   *
   * @param int $year
   * @param int|null $month
   *
   * @return JsonResponse
   */
  public function getUniqueStatistics(int $year, ?int $month = null)
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
  public function getTotalStatistics(int $year, ?int $month = null)
  {
    return response()->json($this->_getTotalStatistics($year, $month));
  }

  /**
   * Get visits count and percentage for each country.
   *
   * @return JsonResponse
   */
  public function getCountriesStatistics()
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
  public function getAvailableDates(?int $year = null)
  {
    return response()->json($this->_getAvailableDates($year));
  }
}
