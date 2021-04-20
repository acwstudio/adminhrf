<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\City\AdminCityResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventsCityRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventsCityRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminCityResource
     */
    public function index(Event $event)
    {
        return new AdminCityResource($event->city);
    }
}
