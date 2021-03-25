<?php

namespace App\Models;

use App\Models\Traits\Commentable;
use App\Models\Traits\Likeable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audiomaterial extends Model
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
     * Get all of the tags for the post.
     */
    public function highlights()
    {
        return $this->morphToMany(Highlight::class, 'highlightable');
    }

}
