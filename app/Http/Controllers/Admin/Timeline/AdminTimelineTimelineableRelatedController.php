<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineTimelineableRelatedController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineTimelineableRelatedController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return AdminArticleResource|AdminBiographyResource
     */
    public function index(Timeline $timeline)
    {
        if ($timeline->timelinable_type === 'biography') {
            return new AdminBiographyResource($timeline->timelinable);
        } elseif ($timeline->timelinable_type === 'article') {
            return new AdminArticleResource($timeline->timelinable);
        } else {
            return response(null, 204);
        }
    }
}
