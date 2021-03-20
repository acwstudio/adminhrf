<?php

namespace App\Listeners;

use App\Events\Disliked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementLikedCounter
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
     * @param  Disliked  $event
     * @return void
     */
    public function handle(Disliked $event)
    {
        optional($event->like->likeable)->decrementLikedCounter();
    }
}
