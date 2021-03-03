<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $appends = ['src', 'preview', 'original'];

    /**
     * Get the parent imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }


    public function getSrcAttribute()
    {
        return $this->attributes['path'] . $this->attributes['name'] . '.' . $this->attributes['ext'];
    }

    public function getPreviewAttribute()
    {
        return $this->attributes['path'] . $this->attributes['name'] . '_min.' . $this->attributes['ext'];
    }

    public function getOriginalAttribute()
    {
        return $this->attributes['original'] ?
            $this->attributes['path'] . $this->attributes['name'] . '_original.' . $this->attributes['ext'] : null;
    }
}
