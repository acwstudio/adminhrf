<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    public $fillable = [
        'title',
        'body',
        'attachable_id',
        'attachable_type'
    ];

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
