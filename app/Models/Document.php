<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, Sluggable, Likeable;

    protected $guarded = [];

    protected $casts = [
        'document_date' => 'datetime',
        'options' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get document's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('order');
    }

    /**
     * Get documents's tags
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function category()
    {
        return $this->BelongsTo(DocumentCategory::class);
    }

    /**
     * Get article's comments
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get article's likes
     */
    public function likes(){
        return $this->morphMany(Like::class,'likeable');
    }

    /**
     * Get count of likes for article
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
     * Check if specific article is liked
     */
    public function checkLiked($userId){
        $val = $this->likes()->first(['user_id']);
        return $val?$val->user_id==$userId:false;
    }

}
