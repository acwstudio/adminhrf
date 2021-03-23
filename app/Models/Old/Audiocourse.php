<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiocourse extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_audio_book_category';

    protected $casts = [
    ];


}
