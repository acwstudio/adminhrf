<?php

namespace App\Http\Controllers\Admin\BioCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioCategory\BioCategoriesBiographiesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use App\Models\BioCategory;
use Illuminate\Http\Request;

/**
 * Class AdminBioCategoriesBiographiesRelationshipsController
 * @package App\Http\Controllers\Admin\BioCategory
 */
class AdminBioCategoriesBiographiesRelationshipsController extends Controller
{
    /**
     * @param BioCategory $bioCategory
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(BioCategory $biocategory)
    {
        return AdminBiographiesIdentifireResource::collection($biocategory->biographies);
    }

    /**
     * @param BioCategoriesBiographiesUpdateRelationshipsRequest $request
     * @param BioCategory $bioCategory
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        BioCategoriesBiographiesUpdateRelationshipsRequest $request, BioCategory $biocategory)
    {
        $ids = $request->input('data.*.id');
        $biocategory->biographies()->sync($ids);

        return response(null, 204);
    }
}
