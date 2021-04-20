<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventCommentsRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventCommentsRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminCommentCollection
     */
    public function index(Event $event)
    {
        return new AdminCommentCollection($event->comments);
    }
}
