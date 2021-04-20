<?php

namespace App\Http\Controllers\Admin\Leisure;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Event\AdminEventResource;
use App\Models\Leisure;
use Illuminate\Http\Request;

/**
 * Class AdminLeisureEventRelatedController
 * @package App\Http\Controllers\Admin\Leisure
 */
class AdminLeisureEventRelatedController extends Controller
{
    /**
     * @param Leisure $leisure
     * @return AdminEventResource
     */
    public function index(Leisure $leisure)
    {
        return new AdminEventResource($leisure->events);
    }
}
