<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Biography extends Model
{
    use HasFactory, Sluggable, Likeable, Commentable;

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
        'created_at' => 'datetime',
        'published_at' => 'datetime',
//	'viewed' => 'bigint'
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

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function bookmarks()
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function categories()
    {
        return $this->belongsToMany(BioCategory::class, 'biography_categories', 'biography_id', 'category_id');
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

    public function hasBookmark(User $user){
        if(is_null($user->bookmarkGroup)){
            return false;
        }
        return is_null($user->bookmarkGroup->bookmarks()->firstWhere('bookmarkable_id', $this->id));
    }

}
