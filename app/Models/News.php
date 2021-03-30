<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Sluggable, Commentable;


    protected $fillable = [
        'title',
        'slug',
        'viewed',
        'announce',
        'listorder',
        'body',
        'show_in_rss',
        'show_in_afisha',
        'yatextid',
        'status',
        'show_in_main',
        'close_commentation',
        'published_at'
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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function hasBookmark(User $user){
        if(is_null($user->bookmarkGroup)){
            return false;
        }
        return is_null($user->bookmarkGroup->bookmarks()->firstWhere('bookmarkable_id', $this->id));
    }


}
