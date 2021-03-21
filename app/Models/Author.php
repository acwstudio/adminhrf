<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fullname'
            ]
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'datetime',
    ];

    /**
     * Get all articles of the author.
     */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'author_article', 'author_id', 'article_id')
            ->where('active', true)
            ->where('published_at', '<', now())
            ->orderBy('published_at', 'desc');
    }

    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'author_film', 'author_id', 'film_id')
                    ->where('active', true)
                    ->where('published_at', '<', now())
                    ->orderBy('published_at', 'desc');
    }

    public function getFullnameAttribute()
    {
        $fullname = Str::of($this->surname);

        if (!is_null($this->patronymic)) {
            $fullname = $fullname->prepend("{$this->patronymic} ");
        }

        if (!is_null($this->firstname)) {
            $fullname = $fullname->prepend("{$this->firstname} ");
        }

        return $fullname;
    }
}
