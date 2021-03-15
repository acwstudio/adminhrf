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
        'slug',
        'show_in_rss',
        'close_commentation',
        'image_id',
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

    public function countLikes(){
        return $this->likes()->count();
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function countComments(){
        return $this->comments()->count();
    }

    public function checkLiked($userId){
        $val = $this->likes()->first(['user_id']);
        return $val?$val->user_id==$userId:false;
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories()
    {
        return $this->belongsToMany(BioCategory::class, 'biography_categories', 'biography_id' , 'category_id');
    }

}
