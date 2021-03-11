<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    use HasFactory;

    public $fillable = [
        'surname',
        'firstname',
        'patronymic',
        'announce',
        'birthname',
        'description',
        'death_date',
        'government_start',
        'government_end',
        'url',
        'slug',
        'show_in_rss',
        'close_commentation',
        'period_id',
        'image_id',
        'stream_id',
        'seo_title',
        'seo_description',
        'seo_keywords'
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

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function countComments(){
        return $this->comments()->count();
    }


    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    public function countLikes(){
        return $this->likes()->count();
    }
}
