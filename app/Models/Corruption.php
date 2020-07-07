<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
