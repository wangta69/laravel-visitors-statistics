<?php

namespace Pondol\VisitorsStatistics\Http\Controllers\Admin;
use Carbon\Carbon;

use Pondol\VisitorsStatistics\Traits\Statistics as t_Statistics;
use Pondol\Charts\Facades\Chartjs;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

  use t_Statistics;

  public function dashboard() {
    
    // all, unique 방문자수 차트
    $today = $this->todayVisitors();
    $visitors = $this->chartingForVisitors();
    $countries = $this->chartingForCountries();
    $devices = $this->chartingForDevices();
    $browsers = $this->chartingForBrowsers();

    return view('visitors::admin.dashboard', compact('today', 'visitors', 'countries', 'devices', 'browsers'));
  }

  private function todayVisitors() {
    $today = Carbon::now()->format('Y-m-d');
    $data = $this->_getTodayStatistics($today);

    return $data;
  } 


  private function chartingForVisitors() {
    $year = Carbon::now()->year;
    $month = Carbon::now()->month;
    $data = $this->_getStatistics($year, $month);

    return Chartjs::
    type('line')
    ->element('dailyChart')
    ->labels(array_keys($data['all']))
    ->datasets(function($dataset) use($data) {
      $dataset->setLabel("# all");
      $dataset->setData(array_values($data['all']));
      $dataset->setBorderWidth(1);
    })
    ->datasets(function($dataset) use($data) {
      $dataset->setLabel("# unique");
      $dataset->setData(array_values($data['unique']));
      $dataset->setBorderWidth(1);
    })
    ->options(function($option) {
      $option->setTitle('Daily visitor');
    })
    ->build();
  } 


  private function chartingForCountries() {
    $data = $this->_getCountriesStatistics();
    $chartData = array_column($data , 'count');
    $chart = Chartjs::refresh()
    ->type('bar')
    ->element('countryChart')

    ->datasets(function($dataset) use($data) {
      $dataset->setData(array_column($data , 'count'));
      $dataset->setdefaultColor();
    })

    ->labels(array_column($data , 'country'));
    $chart = $chart->options(function($option) {
      $option->legend['display'] = false;
      $option->setTitle('Nationals');
    })
    ->build();

    return $chart;
  }

  private function chartingForDevices() {
    $data = $this->_getDeviceStatistics();

    return Chartjs::refresh()
    ->type('bar')
    ->element('deviceChart')
    ->labels(array_column($data , 'device'))
    ->datasets(function($dataset) use($data) {
      $dataset->setData(array_column($data , 'count'));
      // $dataset->setRandomBarColor();
      $dataset->setdefaultColor();
    })
    ->options(function($option) {
      $option->legend['display'] = false;
      $option->setTitle('Devices');
    })
    // ->applyRandomBarColor()
    ->build();
  }

  private function chartingForBrowsers() {
    $data = $this->_getBrowserStatistics();

    return Chartjs::refresh()
    ->type('bar')
    ->element('browserChart')
    ->labels(array_column($data , 'browser'))
    ->datasets(function($dataset) use($data) {
      $dataset->setData(array_column($data , 'count'));
      $dataset->setdefaultColor();
      // $dataset->setRandomBarColor();
    })
    // ->applyRandomBarColor()
    ->options(function($option) {
      $option->legend['display'] = false;
      $option->setTitle('Browsers');
    })
    ->build();
  }
}
