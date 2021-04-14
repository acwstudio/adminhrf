<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, Sluggable, Likeable, Commentable;

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
        return $this->BelongsTo(DocumentCategory::class, 'document_category_id');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function hasBookmark(User $user)
    {
        if (is_null($user->bookmarkGroup)) {
            return false;
        }
        return !is_null($user->bookmarkGroup->bookmarks()->firstWhere('bookmarkable_id', $this->id));
    }

}
