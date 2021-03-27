<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videomaterial extends Model
{
    use HasFactory, Sluggable, Likeable;

    protected $table = 'videomaterials';

    protected $fillable = [
        'body',
        'title',
        'announce',
        'published_at',
        'slug',
        'video_code',
        'show_in_rss',
        'show_in_main',
        'active',
        'type'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'published_at' => 'datetime'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
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

    public function countComments()
    {
        return $this->comments()->count();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function authors()
    {
        return $this->morphToMany(Author::class, 'material', 'author_material');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function hasBookmark(User $user){
        return !is_null($this->bookmarks()->firstWhere('user_id', $user->id));
    }


}
