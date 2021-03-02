<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_old';
    protected $table = 'content_person';

    protected $visible = [
        'id',
        'slug',
        'firstname',
        'surname',
        'patronymic',
        'birth_date',
        'announce',
        'description'
    ];

    /**
     * The authors that belong to the articles.
     */
    public function articles()
    {
        return $this->belongsToMany(
            Article::class,
            'content_artworks_author',
            'person_id',
            'artwork_id');
    }

}
