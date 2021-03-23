<?php


namespace App\Models\Traits;


use App\Models\Comment;
use App\Models\User;

/**
 * Trait Commentable
 * @package App\Models\Traits
 *
 * To add commentable functionality just add this trait to your model and make int column 'commented' in corresponding table
 */
trait Commentable
{

    public function incrementCommentedCounter($qty = 1)
    {
        $this->increment('commented', $qty);
    }

    public function decrementCommentedCounter($qty = 1)
    {
        $this->decrement('commented', $qty);
    }

    /**
     * Check if commented by given user
     * @param User $user
     * @return bool
     */
    public function checkCommented(User $user): bool
    {
        return !is_null($this->comments()->firstWhere('user_id', $user->id));
    }

    /**
     * Get comments relation
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get count of likes for article
     */
    public function countComments()
    {
        return $this->comments()->count();
    }

}
