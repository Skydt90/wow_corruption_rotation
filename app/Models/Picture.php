<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Picture
 *
 * @property int $id
 * @property int $corruption_id
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Corruption $corruptions
 * @method static Builder|Picture newModelQuery()
 * @method static Builder|Picture newQuery()
 * @method static Builder|Picture query()
 * @method static Builder|Picture whereCorruptionId($value)
 * @method static Builder|Picture whereCreatedAt($value)
 * @method static Builder|Picture whereId($value)
 * @method static Builder|Picture wherePath($value)
 * @method static Builder|Picture whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
