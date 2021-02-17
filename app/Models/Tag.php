<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
    ];



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

}
