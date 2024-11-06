<?php

namespace Pondol\VisitorsStatistics;

use Pondol\VisitorsStatistics\Contracts\GeoIP as GeoIPContract;
use Exception;
use Illuminate\Support\Facades\Log;
// use MaxMind\Db\Reader;
use GeoIp2\Database\Reader;

class GeoIP implements GeoIPContract
{
  /**
   * @var string
   */
  private $country = 'Unknown';

  /**
   * @var string
   */
  private $city = 'Unknown';


  private $continent = 'Unknown';

  /**
   * GeoIP constructor.
   *
   * @param string $ipAddress
   */
  public function __construct(string $ipAddress)
  {
    try {
      $storage_path = config('pondol-visitor.storage_path');

      $cityDbReader = new Reader($storage_path.'/GeoLite2-City.mmdb');
      $record = $cityDbReader->city($ipAddress);


      $this->city = $record->city->name;
      $this->country = $record->country->name;
      $this->continent = $record->continent->name;
    
    } catch (Exception $ex) {
      Log::error($ex->getMessage());
    }
  }

  /**
   * Locate country for the set ip.
   *
   * @return string
   */
  public function getCountry(): string
  {
    return $this->country;
  }

  /**
   * Locate city for the set ip.
   *
   * @return string
   */
  public function getCity(): string
  {
    return $this->city;
  }

/**
   * Locate continent for the set ip.
   *
   * @return string
   */
  public function getContinent(): string
  {
    return $this->continent;
  }
}
