<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Schedule
 *
 * @mixin Eloquent
 * @property int $id
 * @property int $rotation_id
 * @property int|null $max_corruption
 * @property string|null $start_date
 * @property string|null $end_date
 * @property-read Rotation $rotation
 * @method static Builder|Schedule newModelQuery()
 * @method static Builder|Schedule newQuery()
 * @method static Builder|Schedule query()
 * @method static Builder|Schedule whereEndDate($value)
 * @method static Builder|Schedule whereId($value)
 * @method static Builder|Schedule whereMaxCorruption($value)
 * @method static Builder|Schedule whereRotationId($value)
 * @method static Builder|Schedule whereStartDate($value)
 */

class Schedule extends Model
{
    public $timestamps  = false;

    protected $fillable = [
        'rotation_id', 'start_date', 'end_date', 'max_corruption'
    ];

    public function rotation()
    {
        return $this->belongsTo(Rotation::class);
    }

    // needed to bypass forced format below
    public function getStartDateClean()
    {
        return $this->attributes['start_date'];
    }

    public function getStartDateAttribute($start_date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $start_date)->format('Y-m-d\TH:i:s.u\Z');
    }

    public function getEndDateAttribute($end_date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $end_date)->format('Y-m-d\TH:i:s.u\Z');
    }
}
