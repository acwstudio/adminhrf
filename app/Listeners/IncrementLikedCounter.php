<?php

namespace App\Listeners;

use App\Events\Liked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementLikedCounter
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
     * @param  Liked  $event
     * @return void
     */
    public function handle(Liked $event)
    {
        optional($event->like->likeable)->incrementLikedCounter();
    }
}
