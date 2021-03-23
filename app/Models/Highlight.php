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

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function countLikes()
    {
        return $this->likes()->count();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function checkLiked($userId)
    {
        $val = $this->likes()->first(['user_id']);
        //$get->user();
        return $val ? $val->user_id == $userId : false;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
