<?php

namespace App\Http\Controllers\Admin\Leisure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leisure\LeisureEventUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Leisure\AdminLeisureIdentifireResource;
use App\Models\Event;
use App\Models\Leisure;
use Illuminate\Http\Request;

/**
 * Class AdminLeisureEventRelationshipsController
 * @package App\Http\Controllers\Admin\Leisure
 */
class AdminLeisureEventRelationshipsController extends Controller
{
    /**
     * @param Leisure $leisure
     * @return AdminLeisureIdentifireResource
     */
    public function index(Leisure $leisure)
    {
        return new AdminLeisureIdentifireResource($leisure->events);
    }

    public function update(LeisureEventUpdateRelationshipsRequest $request, Leisure $leisure)
    {
        $ids = $request->input('data.*.id');
        $id = array_shift($ids);

        $event = Event::find($id);

        $leisure->events()->save($event);

        return response(null, 204);
    }
}
