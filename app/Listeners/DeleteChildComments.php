<?php

namespace App\Listeners;

use App\Events\CommentDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteChildComments
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
        optional($event->comment->commentable)->decrementCommentedCounter($event->comment->children_count);

        $event->comment->children()->delete();
    }
}
