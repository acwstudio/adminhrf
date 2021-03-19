<?php


namespace App\Models\Traits;


use App\Models\Like;
use App\Models\User;

/**
 * Trait Likeable
 * @package App\Models\Traits
 *
 * To add likes functionality just add this trait to your model and make int column 'liked' in corresponding table
 */
trait Likeable
{

    public function incrementLikedCounter($qty = 1)
    {
        $this->increment('liked', $qty);
    }

    public function decrementLikedCounter($qty = 1)
    {
        $this->decrement('liked', $qty);
    }

    /**
     * Check if article is liked by given user
     * @param User $user
     * @return bool
     */
    public function checkLiked(User $user): bool
    {
        return !is_null($this->likes()->firstWhere('user_id', $user->id));
    }

    /**
     * Get likes relation
     */
    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    /**
     * Get count of likes for article
     */
    public function countLikes()
    {
        return $this->likes()->count();
    }

}
