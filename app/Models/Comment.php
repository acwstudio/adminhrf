<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'body',
        'date',
        'commentable_id',
        'commentable_type',
        'parent_id',
    ];


    /* Define polymorphic relation from comments to all other Entities */
    public function commentable()
    {
        return $this->morphTo();
    }


    /* Create relation from parent comment to a reply */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /*Define relation of comment being owned by user*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
