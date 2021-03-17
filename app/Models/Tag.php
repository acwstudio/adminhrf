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
        return $this->morphedByMany(News::class, 'taggable')->select(['id',
            'title',
            'slug',
            'announce',
            'listorder',
            'status',
            'created_at',
            'slug',]);
    }

    public function documents()
    {
        return $this->morphedByMany(Document::class, 'taggable');
    }

    public function biographies()
    {
        return $this->morphedByMany(Biography::class, 'taggable');
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }




}
