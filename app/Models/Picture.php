<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Picture extends Model
{
    protected $fillable = [
        'corruption_id', 'path'
    ];

    public function corruptions()
    {
        return $this->hasMany(Corruption::class);
    }
}
