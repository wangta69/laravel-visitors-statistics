<?php

return [


  /*
  |--------------------------------------------------------------------------
  | Routing
  |--------------------------------------------------------------------------
  |
  | Specifcy prefix and middleware that should be used
  | when registering routes for the package
  |
  */
  'route' => [
    'prefix' => 'visitors',
    'as' => 'visitors.',
    'middleware' => ['web', 'auth']
  ],
  'route_admin' => [
    'prefix' => 'visitors/admin',
    'as' => 'admin.visitors.',
    'middleware' => ['web', 'admin']
  ],
  'component' => ['admin'=>['layout'=>'visitors::admin', 'lnb'=>'visitors::partials.navigation']],

  /*
  unit : day
  after 90 day, visitors_logs data will be deleted
  */
  'visitors_logs_retention_period' => 90,
  'visitors_online_period' => 15,
  'prohibit_ips'=>[], // 이곳에 있는 ips 는 방문자 통계에 잡지 않는다.
  'prohibit_users'=>[], // 이곳에 있는 users는 방뭄자 통계에 잡지 않는다.
  /*
  |--------------------------------------------------------------------------
  | Maxmind database
  |--------------------------------------------------------------------------
  */
  'maxmind_user_id' => env('MAXMIND_USER_ID'),
  'maxmind_license_key' => env('MAXMIND_LICENSE_KEY'),
  'storage_path'=> storage_path('app/GeoIP'),
  'permalink_ASN' => env('GeoLite2_ASN', 'https://download.maxmind.com/geoip/databases/GeoLite2-ASN/download?suffix=tar.gz'),
  'permalink_City' => env('GeoLite2_City', 'https://download.maxmind.com/geoip/databases/GeoLite2-City/download?suffix=tar.gz'),
  'permalink_Country' => env('GeoLite2_Country', 'https://download.maxmind.com/geoip/databases/GeoLite2-Country/download?suffix=tar.gz'),
];
