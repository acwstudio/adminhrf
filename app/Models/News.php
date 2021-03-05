<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'announce',
        'listorder',
        'body',
        'show_in_rss',
        'show_in_afisha',
        'yatextid',
        'status',
        'show_in_main',
        'close_commentation',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at'=> 'datetime',
        'published_at' => 'datetime'
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    public function views(){
        return $this->morphMany(View::class,'viewable','viewable_type','viewable_id');
    }

    public function countLikes(){
        return $this->likes()->count();
    }

    public function getViews(){
        return $this->views();
    }


}
