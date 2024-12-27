<?php

Route::get('', 'DashboardController@dashboard')->name('dashboard');
Route::get('log', 'LogsController@log')->name('log');
Route::get('config', 'ConfigController@edit')->name('config');
