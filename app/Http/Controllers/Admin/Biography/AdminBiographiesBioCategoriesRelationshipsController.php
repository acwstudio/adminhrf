<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographiesBioCategoriesUpdateRelationshipsRequest;
use App\Http\Requests\Biography\BiographiesTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Http\Resources\Admin\BioCategory\AdminBioCategoryIdentifierResource;
use App\Models\Biography;

/**
 * Class AdminBiographiesBioCategoriesRelationshipsController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographiesBioCategoriesRelationshipsController extends Controller
{
    /**
     * @param Biography $biography
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Biography $biography)
    {
        return AdminBioCategoryIdentifierResource::collection($biography->categories);
    }

    /**
     * @param BiographiesTagsUpdateRelationshipsRequest $request
     * @param Biography $biography
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(BiographiesBioCategoriesUpdateRelationshipsRequest $request, Biography $biography)
    {
        $ids = $request->input('data.*.id');

        $biography->categories()->sync($ids);

        return response(null, 204);
    }
}
