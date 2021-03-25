<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BiographyCommentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Biography;

/**
 * Class AdminBiographyCommentsRelationshipsController
 * @package App\Http\Controllers\Admin
 */
class AdminBiographyCommentsRelationshipsController extends Controller
{
    /**
     * @param Biography $biography
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Biography $biography)
    {
        return AdminCommentsIdentifierResource::collection($biography->comments);
    }

    /**
     * @param BiographyCommentsUpdateRelationshipsRequest $request
     * @param Biography $biography
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(BiographyCommentsUpdateRelationshipsRequest $request, Biography $biography)
    {
        $ids = $request->input('data.*.id');
//        $biography->comments()->($ids);

//        return response(null, 204);
        return response()->json('It is not ready');
    }
}
