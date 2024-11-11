<?php
namespace Pondol\VisitorsStatistics\Models;
use Illuminate\Database\Eloquent\Model;

class VisitorsLog extends Model
{
  // protected $table = 'visitors_logs';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'ip', 'user_id', 'continent', 'country', 'city', 'device', 'browser', 'referer'
  ];

  const UPDATED_AT = null;

}
