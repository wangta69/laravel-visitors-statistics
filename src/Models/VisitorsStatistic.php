<?php

namespace Pondol\VisitorsStatistics\Models;

use Illuminate\Database\Eloquent\Model;


class VisitorsStatistic extends Model
{
  public const TYPES = [
    'all' => 'all',
    'unique' => 'unique'
  ];

  /**
   * The table associated with the model.
   *
   * @var string
   */
  // protected $table = 'visitorsstatistics_statistics';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'date', 'type', 'value'
  ];


  /**
   * Get the total number of visitors.
   *
   * @return int
   */
  public static function getTotalVisitors(): int
  {
    return VisitorsStatistic::where('type', self::TYPES['all'])->sum('value');
  }

  /**
   * Get the total number of unique visitors.
   *
   * @return int
   */
  public static function getTotalUniqueVisitors(): int
  {
    return VisitorsStatistic::where('type', self::TYPES['unique'])->sum('value');
  }
}
