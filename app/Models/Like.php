<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    /* Define polymorphic relation from likes to all other Entities */

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'likeable');
    }

    public function biographies()
    {
        return $this->morphedByMany(Biography::class, 'likeable');
    }

    public function documents()
    {
        return $this->morphedByMany(Document::class, 'likeable');
    }

    public function getUserId()
    {
        return $this->get('user_id');
    }

    /**
     * Deprecated or supposed for future features
     */
    /*
     *
    public function news()
    {
        return $this->morphedByMany(News::class, 'likeable');
    }
     */
}
