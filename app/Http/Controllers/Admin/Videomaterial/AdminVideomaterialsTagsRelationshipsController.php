<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videomaterial\VideomaterialsTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialsTagsRelationshipsController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return AdminTimelineIdentifierResource::collection($videomaterial->tags);
    }

    /**
     * @param VideomaterialsTagsUpdateRelationshipsRequest $request
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        VideomaterialsTagsUpdateRelationshipsRequest $request, Videomaterial $videomaterial)
    {
        $ids = $request->input('data.*.id');
        $videomaterial->tags()->sync($ids);

        return response(null, 204);
    }
}
