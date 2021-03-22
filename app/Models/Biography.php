<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Biography extends Model
{
    use HasFactory, Sluggable, Likeable;

    public $fillable = [
        'surname',
        'firstname',
        'patronymic',
        'announce',
        'birth_date',
        'description',
        'death_date',
        'government_start',
        'government_end',
        'slug',
        'show_in_rss',
        'close_commentation',
        'image_id',
        'published_at',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at'=> 'datetime',
        'published_at' => 'datetime'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fullname'
            ]
        ];
    }

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
        //$get->user();
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

    public function getFullnameAttribute()
    {
        $fullname = Str::of($this->surname);

        if (!is_null($this->patronymic)) {
            $fullname = $fullname->prepend("{$this->patronymic} ");
        }

        if (!is_null($this->firstname)) {
            $fullname = $fullname->prepend("{$this->firstname} ");
        }

        return $fullname;
    }

    public function timeline()
    {
        return $this->morphOne(Timeline::class, 'timelinable');
    }

}
