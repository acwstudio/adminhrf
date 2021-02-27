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
