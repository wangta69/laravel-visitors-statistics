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
  'prefix' => '',
  'middleware' => ['web', 'auth'],

  /*
  unit : day
  after 90 day, visitors_logs data will be deleted
  */
  'visitors_logs_retention period' => 90,

  /*
  |--------------------------------------------------------------------------
  | Maxmind database
  |--------------------------------------------------------------------------
  */
  'maxmind_user_id' => env('MAXMIND_USER_ID'),
  'maxmind_license_key' => env('MAXMIND_LICENSE_KEY'),
  'permalink_ASN' => env('GeoLite2_ASN', 'https://download.maxmind.com/geoip/databases/GeoLite2-ASN/download?suffix=tar.gz'),
  'permalink_City' => env('GeoLite2_City', 'https://download.maxmind.com/geoip/databases/GeoLite2-City/download?suffix=tar.gz'),
  'permalink_Country' => env('GeoLite2_Country', 'https://download.maxmind.com/geoip/databases/GeoLite2-Country/download?suffix=tar.gz'),
];
