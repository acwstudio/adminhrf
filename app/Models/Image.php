<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    const SRC_FLAG = 1 << 0;
    const PREVIEW_FLAG = 1 << 1;
    const ORIGINAL_FLAG = 1 << 2;

    protected $appends = ['src', 'preview', 'original'];

    protected $casts = [
        'original' => 'boolean',
    ];

    protected $guarded = [];

    /**
     * Delete image files from storage when model deleted
     */
    protected static function booted()
    {
        static::deleted(function ($image) {

            if ($image->flags & self::SRC_FLAG) {
                Storage::delete($image->src);
            }

            if ($image->flags & self::PREVIEW_FLAG) {
                Storage::delete($image->preview);
            }

            if ($image->flags & self::ORIGINAL_FLAG) {
                Storage::delete($image->original);
            }

        });
    }


    /**
     * Get the parent imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }


    public function getSrcAttribute()
    {
        if ($this->flags & self::SRC_FLAG) {
            return $this->path . $this->name . '.' . $this->ext;
        }

        return null;

    }

    public function getPreviewAttribute()
    {
        if ($this->flags & self::PREVIEW_FLAG) {
            return $this->path . $this->name . '_min.' . $this->ext;
        }

        return null;

    }

    public function getOriginalAttribute()
    {

        if ($this->flags & self::ORIGINAL_FLAG) {
            return $this->original ? $this->path . $this->name . '_original.' . $this->ext : null;
        }

        return null;
    }
}
