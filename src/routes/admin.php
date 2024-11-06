<?php

Route::get('', 'StatisticsController@dashboard')->name('dashboard');

Route::get('statistics/{year}/{month?}', 'StatisticsController@getStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('all_statistics');

Route::get('statistics/unique/{year}/{month?}', 'StatisticsController@getUniqueStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('unique_statistics');

Route::get('statistics/total/{year}/{month?}', 'StatisticsController@getTotalStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('total_statistics');

Route::get('statistics/countries', 'StatisticsController@getCountriesStatistics')
  ->name('countries');

Route::get('statistics/available/{year?}', 'StatisticsController@getAvailableDates')
  ->where(['year' => '\d{4}'])
  ->name('available_dates');
