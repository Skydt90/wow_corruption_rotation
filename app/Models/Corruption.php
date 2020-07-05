<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Corruption extends Model
{
    protected $fillable = [
        'name', 'description', 'wowhead_link', 'corr_cost', 'echo_cost'
    ];

    public function rotations()
    {
        return $this->belongsToMany(Rotation::class, 'corruption_rotations')->withTimestamps();
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }

}
