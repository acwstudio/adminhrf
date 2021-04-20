<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventsCityUpdateRelationshipsRequest;
use App\Http\Resources\Admin\City\AdminCityIdentifireResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventsCityRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventsCityRelationshipsController extends Controller
{
    /**
     * @param Event $event
     * @return AdminCityIdentifireResource
     */
    public function index(Event $event)
    {
        return new AdminCityIdentifireResource($event->city);
    }

    /**
     * @param EventsCityUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(EventsCityUpdateRelationshipsRequest $request, Event $event)
    {
        $ids = $request->input('data.*.id');

        $event->city()->associate($ids);

        return response(null, 204);
    }
}
