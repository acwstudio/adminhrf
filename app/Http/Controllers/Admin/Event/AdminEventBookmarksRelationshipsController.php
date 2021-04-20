<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventBookmarksRelationshipsController extends Controller
{
    /**
     * @param Event $event
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Event $event)
    {
        return AdminBookmarkIdentifierResource::collection($event->bookmarks);
    }

    /**
     * @param EventBookmarksUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(EventBookmarksUpdateRelationshipsRequest $request, Event $event)
    {
        return response('Обновление закладок для события отключено', 405);
    }
}
