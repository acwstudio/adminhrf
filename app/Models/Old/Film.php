<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_film';

    protected $casts = [
        'date' => 'datetime',
        'updatedat' => 'datetime',
    ];

    /**
     * The authors that belong to the articles.
     */
    public function authors()
    {
        return $this->belongsToMany(
            Person::class,
            'content_film_author',
            'film_id',
            'person_id');
    }

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
