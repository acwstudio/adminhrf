<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'announce',
        'listorder',
        'body',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'show_in_rss',
        'yatextid',
        'status',
        'image_id',
        'show_in_main',
        'close_commentation',
        'gallery_id',
        'author_id',
    ];


    protected $casts = [
        'updated_at' => 'datetime',
        'created_at'=> 'datetime',
        #'last_upliked'=> 'datetime',
        #last_viewed' => 'datetime'
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function cycleables()
    {
        return $this->morphMany(Cycle::class, 'cycleable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

}
