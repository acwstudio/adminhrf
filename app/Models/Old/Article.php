<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_artworks';

    /**
     * The authors that belong to the articles.
     */
    public function authors()
    {
        return $this->belongsToMany(
            Person::class,
            'content_artworks_author',
            'artwork_id',
            'person_id');
    }

}
