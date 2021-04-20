<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Like\AdminLikeCollection;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventsLikesRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventsLikesRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminLikeCollection
     */
    public function index(Event $event)
    {
        return new AdminLikeCollection($event->likes);
    }
}
