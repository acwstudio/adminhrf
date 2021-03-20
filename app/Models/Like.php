<?php

namespace App\Models;

use App\Events\Disliked;
use App\Events\Liked;
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

    protected $dispatchesEvents = [
        'saved' => Liked::class,
        'deleted' => Disliked::class,
    ];

    /**
     * Get the parent likeable model (article, biography, document, test, etc)
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Get related user
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }



}
