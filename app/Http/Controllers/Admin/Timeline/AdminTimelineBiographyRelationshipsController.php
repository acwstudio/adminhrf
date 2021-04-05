<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBiographiesIdentifireResource;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineBiographyRelationshipsController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineBiographyRelationshipsController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return AdminBiographiesIdentifireResource
     */
    public function index(Timeline $timeline)
    {
        return new AdminBiographiesIdentifireResource($timeline->timelinable);
//        return $timeline->timelinable;
    }
}
