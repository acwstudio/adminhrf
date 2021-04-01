<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementCommentedCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentAdded  $event
     * @return void
     */
    public function handle(CommentAdded $event)
    {
        // Increment parent's children counter
        if (!is_null($event->comment->parent_id)) {
            $event->comment->parent()->increment('children_count');
        }

        optional($event->comment->commentable)->incrementCommentedCounter();
    }
}
