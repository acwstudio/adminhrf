<?php

namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Event\AdminEventCollection;
use App\Models\City;
use Illuminate\Http\Request;

/**
 * Class AdminCityEventsRelatedController
 * @package App\Http\Controllers\Admin\City
 */
class AdminCityEventsRelatedController extends Controller
{
    /**
     * @param City $city
     * @return AdminEventCollection
     */
    public function index(City $city)
    {
        return new AdminEventCollection($city->events);
    }
}
