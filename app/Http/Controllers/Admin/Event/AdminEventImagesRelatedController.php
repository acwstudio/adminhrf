<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Class AdminEventImagesRelatedController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventImagesRelatedController extends Controller
{
    /**
     * @param Event $event
     * @return AdminImageCollection
     */
    public function index(Event $event)
    {
        return new AdminImageCollection($event->images);
    }
}
