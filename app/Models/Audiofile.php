<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Audiofile
 * @package App\Models
 */
class Audiofile extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'path',
        'audiomaterial_id'
    ];


    protected static function booted()
    {
        static::deleted(function ($file) {

            Storage::delete($file->path);

        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audiomaterial()
    {
        return $this->belongsTo(Audiomaterial::class);
    }
}
