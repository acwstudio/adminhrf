<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory, Sluggable, Likeable, Commentable;

    protected $guarded = [];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get podcast images.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function hasBookmark(User $user){
        if(is_null($user->bookmarkGroup)){
            return false;
        }
        return !is_null($user->bookmarkGroup->bookmarks->firstWhere('bookmarkable_id', $this->id));
    }
}
