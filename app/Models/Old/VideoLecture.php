<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLecture extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_film';

    protected $casts = [
        'date' => 'datetime',
        'updatedat' => 'datetime',
    ];


    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
