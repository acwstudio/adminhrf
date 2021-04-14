<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographiesTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographiesTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographiesTagsRelationshipsController extends Controller
{
    /**
     * @param Biography $biography
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Biography $biography)
    {
        return AdminTagIdentifierResource::collection($biography->tags);
    }

    /**
     * @param Request $request
     * @param Biography $biography
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(BiographiesTagsUpdateRelationshipsRequest $request, Biography $biography)
    {
        $ids = $request->input('data.*.id');
        $biography->tags()->sync($ids);

        return response(null, 204);
    }
}
