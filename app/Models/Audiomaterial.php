<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiomaterial extends Model
{
    use HasFactory, Sluggable, Likeable, Commentable;

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'description',
        'position',
        'show_in_rss_apple'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get all
     */
    public function highlights()
    {
        return $this->morphToMany(Highlight::class, 'highlightable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function audiofile()
    {
        return $this->hasOne(Audiofile::class);
    }

    public function getfilepathAttribute()
    {

            return optional($this->audiofile)->path;

    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function hasBookmark(User $user)
    {
        if (is_null($user->bookmarkGroup)) {
            return false;
        }
        return !is_null($user->bookmarkGroup->bookmarks->firstWhere('bookmarkable_id', $this->id));
    }
}
