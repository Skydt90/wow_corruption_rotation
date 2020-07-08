<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rotation
 *
 * @property int $id
 * @property string $name
 * @property-read Collection|Schedule[] $Schedule
 * @property-read int|null $schedule_count
 * @property-read Collection|Corruption[] $corruptions
 * @property-read int|null $corruptions_count
 * @method static Builder|Rotation newModelQuery()
 * @method static Builder|Rotation newQuery()
 * @method static Builder|Rotation query()
 * @method static Builder|Rotation whereId($value)
 * @method static Builder|Rotation whereName($value)
 * @mixin Eloquent
 */

class Rotation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function corruptions()
    {
        return $this->hasMany(Corruption::class);
    }

    public function Schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
