<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsTagsRelationshipsController extends Controller
{
    /**
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminTagIdentifierResource::collection($news->tags);
    }

    /**
     * @param NewsTagsUpdateRelationshipsRequest $request
     * @param News $news
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(NewsTagsUpdateRelationshipsRequest $request, News $news)
    {
        $ids = $request->input('data.*.id');
        $news->tags()->sync($ids);

        return response(null, 204);
    }
}
