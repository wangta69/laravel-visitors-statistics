<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Tracking conditions
  |--------------------------------------------------------------------------
  */

  // 'track_authenticated_users' => false,

  // 'track_ajax_request' => false,

  /*
  |--------------------------------------------------------------------------
  | Login attempts
  |--------------------------------------------------------------------------
  |
  | Login attempts should not be tracked as visits
  | If you want to track them set the value to false
  |
  */

  // 'login_route_path' => 'admin',

  /*
  |--------------------------------------------------------------------------
  | Routing
  |--------------------------------------------------------------------------
  |
  | Specifcy prefix and middleware that should be used
  | when registering routes for the package
  |
  */

  // 'prefix' => 'admin',
  'prefix' => '',
  'middleware' => ['web', 'auth'],

  /*
  |--------------------------------------------------------------------------
  | Maxmind database
  |--------------------------------------------------------------------------
  */
  'user_id' => env('MAXMIND_USER_ID'),
  'license_key' => env('MAXMIND_LICENSE_KEY'),
  'permalink_ASN' => env('GeoLite2_ASN', 'https://download.maxmind.com/geoip/databases/GeoLite2-ASN/download?suffix=tar.gz'),
  'permalink_City' => env('GeoLite2_City', 'https://download.maxmind.com/geoip/databases/GeoLite2-City/download?suffix=tar.gz'),
  'permalink_Country' => env('GeoLite2_Country', 'https://download.maxmind.com/geoip/databases/GeoLite2-Country/download?suffix=tar.gz'),
];
