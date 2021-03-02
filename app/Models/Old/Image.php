<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'sip_media_gallery_media';

    public function article()
    {
        return $this->belongsTo(Article::class, 'image_id', 'id');
    }
}
