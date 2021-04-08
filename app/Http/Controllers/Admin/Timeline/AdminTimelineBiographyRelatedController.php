<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBiographyResource;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineBiographyRelatedController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineBiographyRelatedController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return AdminBiographyResource
     */
    public function index(Timeline $timeline)
    {
//        if ($timeline->timelinable_type === 'biography') {
//            return new AdminBiographyResource($timeline->timelinable);
//        } else {
//            return response()->json(['message' => 'does not exist']);
//        }
//        return $timeline->timelinable()->where('timelinable_type', 'biography')->get();
        return response()->json(['message' => 'Is not ready']);
    }
}
