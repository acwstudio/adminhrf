<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug'=>[
                'source' => 'title'
            ]
        ];
    }

    public $fillable = [
        'title',
        'description',
        'is_active',
        'time',
    ];

    public $casts = [
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
    ];


    public function categories(){
        return $this->belongsToMany(QCategory::class,'tests_categories','test_id','category_id');
    }

    public function questions(){
        return $this->belongsToMany(Question::class, 'tests_question');
    }

    public function result(){
        return $this->belongsTo(Test::class, 'test_id','id');
    }

    /**
     * Get test's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get test's comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get test's likes
     */
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    /**
     * Get count of likes for test
     */
    public function countLikes(){
        return $this->likes()->count();
    }

    public function countComments(){
        return $this->comments()->count();
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Check if specific test is liked
     */
    public function checkLiked($userId){
        $val = $this->likes()->first(['user_id']);
        return $val?$val->user_id==$userId:false;
    }






}
