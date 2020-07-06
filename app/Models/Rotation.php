<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rotation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function corruptions()
    {
        return $this->belongsToMany(Corruption::class, 'corruption_rotations')->withTimestamps();
    }

    public function Schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}