<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Corruption
 *
 * @property int $id
 * @property int $rotation_id
 * @property string $name
 * @property string $description
 * @property string $corr_cost
 * @property int|null $echo_cost
 * @property int $blizz_item_id
 * @property string $wowhead_link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Picture|null $picture
 * @property-read Rotation $rotations
 * @method static Builder|Corruption newModelQuery()
 * @method static Builder|Corruption newQuery()
 * @method static Builder|Corruption query()
 * @method static Builder|Corruption whereBlizzItemId($value)
 * @method static Builder|Corruption whereCorrCost($value)
 * @method static Builder|Corruption whereCreatedAt($value)
 * @method static Builder|Corruption whereDescription($value)
 * @method static Builder|Corruption whereEchoCost($value)
 * @method static Builder|Corruption whereId($value)
 * @method static Builder|Corruption whereName($value)
 * @method static Builder|Corruption whereRotationId($value)
 * @method static Builder|Corruption whereUpdatedAt($value)
 * @method static Builder|Corruption whereWowheadLink($value)
 * @mixin Eloquent
 */
class Corruption extends Model
{
    protected $fillable = [
        'name', 'description', 'wowhead_link', 'corr_cost', 'echo_cost'
    ];

    public function rotations()
    {
        return $this->belongsTo(Rotation::class);
    }

    public function picture()
    {
        return $this->hasOne(Picture::class);
    }

    // global scope to always return with relationships
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(function (Builder $query) {
            return $query->with('picture');
        });
    }

}
