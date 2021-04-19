<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timeline\TimelineTimelineableUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineTimelineableRelationshipsController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineTimelineableRelationshipsController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return AdminArticleIdentifireResource|AdminBiographiesIdentifireResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Timeline $timeline)
    {
        if ($timeline->timelinable_type === 'biography') {
            return new AdminBiographiesIdentifireResource($timeline->timelinable);
        } elseif ($timeline->timelinable_type === 'article') {
            return new AdminArticleIdentifireResource($timeline->timelinable);
        } else {
            return response(null, 204);
        }
    }

    /**
     * @param TimelineTimelineableUpdateRelationshipsRequest $request
     * @param Timeline $timeline
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TimelineTimelineableUpdateRelationshipsRequest $request, Timeline $timeline)
    {
        return response('обновление временно отключено', 405);
    }
}
