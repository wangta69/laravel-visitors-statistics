<?php

Route::get('statistics/{year}/{month?}', 'ApiController@getStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('all_statistics');

Route::get('statistics/unique/{year}/{month?}', 'ApiController@getUniqueStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('unique_statistics');

Route::get('statistics/total/{year}/{month?}', 'ApiController@getTotalStatistics')
  ->where(['year' => '\d{4}','month' => '\d{1,2}'])
  ->name('total_statistics');

Route::get('statistics/countries', 'ApiController@getCountriesStatistics')
  ->name('countries');

Route::get('statistics/available/{year?}', 'ApiController@getAvailableDates')
  ->where(['year' => '\d{4}'])
  ->name('available_dates');
