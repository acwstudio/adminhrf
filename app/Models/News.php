<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, Sluggable;



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
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
        'created_at'=> 'datetime',
        'published_at' => 'datetime'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function countComments(){
        return $this->comments()->count();
    }

    /**
     * Check if specific article is liked
     */
    public function checkLiked($userId){
        $val = $this->likes()->first(['user_id']);
        return $val?$val->user_id==$userId:false;
    }

    /**
     * Deprecated or supposed for future features
     */
    /*    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    public function countLikes(){
        return $this->likes()->count();
    }*/

}
