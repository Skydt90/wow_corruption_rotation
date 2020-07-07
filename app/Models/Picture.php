<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $fillable = [
        'corruption_id', 'path'
    ];

    public function corruptions()
    {
        return $this->belongsTo(Corruption::class);
    }

    public function getEchoUrl()
    {
        return Storage::url('public/images/echo.jpg');
    }

    public function getCorrUrl()
    {
        return Storage::url('public/images/corruption.jpg');
    }

    public function getUrl()
    {
        return Storage::url($this->path);
    }
    
    public function getMimeType()
    {
        return Storage::mimeType($this->path);
    }
}
