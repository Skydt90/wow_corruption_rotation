<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rotation extends Model
{
    protected $fillable = [
        'start_date', 'end_date'
    ];

    public function corruptions()
    {
        return $this->belongsToMany(Corruption::class, 'corruption_rotations')->withTimestamps();
    }
}
