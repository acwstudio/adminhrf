<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $fillable = [
        'comment_id',
        'commentable_id',
        'commentable_type',
    ];



    public function articles()
    {
        return $this->morphMany(Article::class, 'commentable');
    }

    public function news()
    {
        return $this->morphMany(News::class, 'commentable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'commentable');
    }

    public function biographies()
    {
        return $this->morphMany(Biography::class, 'commentable');
    }
}
