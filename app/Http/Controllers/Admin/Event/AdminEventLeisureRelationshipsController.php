<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventLeisureUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Leisure\AdminLeisureIdentifireResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventLeisureRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventLeisureRelationshipsController extends Controller
{
    /**
     * @param Event $event
     * @return AdminLeisureIdentifireResource
     */
    public function index(Event $event)
    {
        return new AdminLeisureIdentifireResource($event->leisure);
    }

    /**
     * @param EventLeisureUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(EventLeisureUpdateRelationshipsRequest $request, Event $event)
    {
        $ids = $request->input('data.*.id');
        $id = array_shift($ids);
        $event->leisure()->associate($id)->save();

        return response(null, 204);
    }
}
