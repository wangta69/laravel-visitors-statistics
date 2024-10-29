<?php

namespace Pondol\VisitorsStatistics\Contracts;

interface GeoIP
{
  /**
   * Locate country for the set ip.
   *
   * @return string
   */
  public function getCountry(): string;

  /**
   * Locate city for the set ip.
   *
   * @return string
   */
  public function getCity(): string;

  /**
   * Locate continent for the set ip.
   *
   * @return string
   */
  public function getContinent(): string;
}
