<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventBookmarksRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminBookmarkCollection
     */
    public function index(Event $event)
    {
        return new AdminBookmarkCollection($event->bookmarks);
    }
}
