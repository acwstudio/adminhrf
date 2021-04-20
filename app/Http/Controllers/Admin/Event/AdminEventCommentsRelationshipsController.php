<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCommentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventCommentsRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventCommentsRelationshipsController extends Controller
{
    /**
     * @param Event $event
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Event $event)
    {
        return AdminCommentsIdentifierResource::collection($event->comments);
    }

    /**
     * @param EventCommentsUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(EventCommentsUpdateRelationshipsRequest $request, Event $event)
    {
        return response('Обновление комментов для события отключено', 405);
    }
}
