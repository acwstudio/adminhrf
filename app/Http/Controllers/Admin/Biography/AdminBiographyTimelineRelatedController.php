<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTimelineResource;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyTimelineRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyTimelineRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return AdminTimelineResource
     */
    public function index(Biography $biography)
    {
        return new AdminTimelineResource($biography->timeline);
    }
}
