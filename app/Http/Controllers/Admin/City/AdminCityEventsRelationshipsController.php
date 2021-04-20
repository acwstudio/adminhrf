<?php

namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityEventsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Event\AdminEventIdentifierResource;
use App\Models\City;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminCityEventsRelationshipsController
 * @package App\Http\Controllers\Admin\City
 */
class AdminCityEventsRelationshipsController extends Controller
{
    /**
     * @param City $city
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(City $city)
    {
        return AdminEventIdentifierResource::collection($city->events);
    }

    /**
     * @param CityEventsUpdateRelationshipsRequest $request
     * @param City $city
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(CityEventsUpdateRelationshipsRequest $request, City $city)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $id) {
            $event = Event::find($id);
            $city->events()->save($event);
        }

        return response(null, 204);
    }
}
