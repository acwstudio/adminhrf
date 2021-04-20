<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Leisure\AdminLeisureResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventLeisureRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventLeisureRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminLeisureResource
     */
    public function index(Event $event)
    {
        return new AdminLeisureResource($event->leisure);
    }
}
