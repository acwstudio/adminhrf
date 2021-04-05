<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, Sluggable;

    public $fillable = [
        'title',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /* Define polymorphic relation from tags to all other Entities */
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    public function documents()
    {
        return $this->morphedByMany(Document::class, 'taggable');
    }

    public function biographies()
    {
        return $this->morphedByMany(Biography::class, 'taggable');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function highlights()
    {
        return $this->morphedByMany(Highlight::class, 'taggable');
    }

    public function videomaterials()
    {
        return $this->morphedByMany(Videomaterial::class, 'taggable');
    }

    public function audiomaterials()
    {
        return $this->morphedByMany(Audiomaterial::class, 'taggable');
    }

    public function hasSubscription(User $user){

        if(is_null($user->subscriptions)){
            return false;
        }
        return !is_null($user->subscriptions->firstWhere('tag_id', $this->id));
    }

}
