<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Http\Resources\Admin\TimeLine\AdminTimelineResource;
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
     * @return AdminTimelineResource
     */
    public function index(Timeline $timeline)
    {
        $timeline->load('timelinable');

        return AdminTimelineResource::make($timeline);
    }
}
