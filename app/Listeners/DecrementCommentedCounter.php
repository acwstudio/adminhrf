<?php

namespace App\Listeners;

use App\Events\CommentDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementCommentedCounter
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
     * @param  CommentDeleted  $event
     * @return void
     */
    public function handle(CommentDeleted $event)
    {
        // Decrement parent's children counter
        if (!is_null($event->comment->parent_id)) {
            $event->comment->parent()->decrement('children_count');
        }

        optional($event->comment->commentable)->decrementCommentedCounter();
    }
}
