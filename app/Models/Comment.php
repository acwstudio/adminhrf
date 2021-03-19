<?php

namespace App\Models;

use App\Models\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, Likeable;

    public $guarded = [];

    protected $casts = [
        'answer_to' => 'array'
    ];


    /**
     * Define polymorphic relation from comments to all other Entities
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    /**
     * Define relation of comment being owned by user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

}
