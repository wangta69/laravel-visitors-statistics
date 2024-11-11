<?php

Route::get('', 'DashboardController@dashboard')->name('dashboard');

Route::get('log', 'LogsController@log')->name('log');

