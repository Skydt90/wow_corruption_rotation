<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'rotation_id', 'start_date', 'end_date', 'max_corruption'
    ];

    public function rotation()
    {
        return $this->hasOne(Rotation::class);
    }
}
