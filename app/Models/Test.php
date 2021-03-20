<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\TestResult;

class Test extends Model
{
    use HasFactory,Sluggable, Likeable;

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

    public function messages(){
        return $this->hasMany(TestMessage::class, 'test_id','id');
    }

    public function results(){
        return $this->hasMany(TestResult::class, 'test_id','id');
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

    public function checkSolved($userId){
        $val = $this->results()->where('user_id','=',$userId)->first(['is_closed']);
        return $val?$val->is_closed:false;
    }






}
