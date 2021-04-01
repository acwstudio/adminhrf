<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory, Likeable, Commentable;

    public $fillable = [
        'title',
        'description',
        'is_active',
        'time',
    ];
    public $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsToMany(QCategory::class, 'tests_categories', 'test_id', 'category_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'tests_question');
    }

    public function messages()
    {
        return $this->hasMany(TestMessage::class);
    }

    /**
     * Get test's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get test's likes
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get test's comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }


    public function checkSolved($userId)
    {
        $val = $this->results()->where('user_id', '=', $userId)->first(['is_closed']);
        return $val ? $val->is_closed : false;
    }

    public function results()
    {
        return $this->hasMany(TResult::class, 'test_id', 'id');
    }


}
