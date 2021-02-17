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
        'url',
        'announce',
        'listorder',
        'body',
        'listorder',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'show_in_rss',
        'show_in_afisha',
        'yatextid',
        'status',
        'image_id',
        'show_in_main',
        'close_commentation',
        'gallery_id',
        'date'
    ];


    protected $casts = [
        'updated_at' => 'datetime',
        'created_at'=> 'datetime',
    ];


    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


}
