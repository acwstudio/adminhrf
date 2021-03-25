<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_audio_book';


    public function category()
    {
        return $this->belongsTo(Audiocourse::class, 'category_id');
    }
}
