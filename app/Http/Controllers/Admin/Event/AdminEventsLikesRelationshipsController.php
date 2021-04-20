<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventsLikesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Like\AdminLikeIdentifierResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventsLikesRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventsLikesRelationshipsController extends Controller
{
    /**
     * @param Event $event
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Event $event)
    {
        return AdminLikeIdentifierResource::collection($event->likes);
    }

    /**
     * @param EventsLikesUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(EventsLikesUpdateRelationshipsRequest $request, Event $event)
    {
        return response('Обновление лайков для события отключено', 405);
    }
}
