<?php

namespace Pondol\VisitorsStatistics\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  // protected $table = 'visitors';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'ip', 'continent', 'country', 'city', 'device', 'browser'
  ];

  /**
   * Get visitor count for all visitor countries.
   *
   * @return Collection
   */
  public static function getVisitorCountPerCountry(): Collection
  {
    return Visitor::select(['country', DB::raw('COUNT(*) as count')])
      ->groupBy('country')
      ->orderBy('count', 'DESC')
      ->get();
  }

  /**
   * Get the number of online users
   *
   * @param int $minutes
   *
   * @return int
   */
  public static function onlineCount(int $minutes = 15): int
  {
    $date = Carbon::now()->subMinutes($minutes);

    return Visitor::where('updated_at', '>=', $date)->count();
  }
}
