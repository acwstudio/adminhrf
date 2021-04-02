<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBiographiesIdentifireResource;
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
        return AdminBiographiesIdentifireResource::collection($biography->tags);
    }

    /**
     * @param Request $request
     * @param Biography $biography
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(Request $request, Biography $biography)
    {
        $ids = $request->input('data.*.id');
        $biography->tags()->sync($ids);

        return response(null, 204);
    }
}
