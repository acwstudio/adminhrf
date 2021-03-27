<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory, Sluggable, Likeable;

    protected $fillable = [
        'title',
        'type',
        'announce',
        'order',
        'active',
    ];
    protected $casts = [
        'published_at' => 'datetime'
    ];
    private $coursesTypes = [
        'audiocourse',
        'videocourse',
        'course',
        'highlight'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function highlightable()
    {
        return $this->hasMany(Highlightable::class, 'highlight_id', 'id');
    }

    /**
     * Get all of the audiomaterials that are assigned this highlight.
     */
    public function audiomaterials()
    {
        return $this->morphedByMany(Audiomaterial::class, 'highlightable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function hasBookmark(User $user){
        if(is_null($this->bookmarks())){
            return false;
        }
        return is_null($this->bookmarks()->first()->bookmarkGroup()->firstWhere('user_id', $user->id));
    }
}
