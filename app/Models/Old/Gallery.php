<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'sip_media_gallery';

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'sip_media_gallery_has_media',
            'gallery_id',
            'media_id')->withPivot('position', 'enabled', 'created_at')->orderBy('pivot_position', 'asc');
    }
}
