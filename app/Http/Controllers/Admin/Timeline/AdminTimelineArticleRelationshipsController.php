<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timeline\TimelineArticleUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Models\Article;
use App\Models\Timeline;
use Illuminate\Http\Request;

/**
 * Class AdminTimelineArticleRelationshipsController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineArticleRelationshipsController extends Controller
{
    /**
     * @param Timeline $timeline
     * @return AdminArticleIdentifireResource
     */
    public function index(Timeline $timeline)
    {
//        return new AdminArticleIdentifireResource($timeline->timelinable);
        return ['message' => 'Is not ready'];
    }

    /**
     * @param TimelineArticleUpdateRelationshipsRequest $request
     * @param Timeline $timeline
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TimelineArticleUpdateRelationshipsRequest $request, Timeline $timeline)
    {
//        $ids = $request->input('data.*.id');
//
//        foreach ($ids as $id) {
//            $article = Article::find($id);
//            $timeline->timelinable()->associate($article)->save();
//        }
//
//
//        return response()->json(['ok']);
        return ['message' => 'Is not ready'];
    }
}
