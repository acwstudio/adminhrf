<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialsTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Tag\AdminTagIdentifierResource;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialsTagsRelationshipsController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return AdminTagIdentifierResource::collection($audiomaterial->tags);
    }

    /**
     * @param AudiomaterialsTagsUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AudiomaterialsTagsUpdateRelationshipsRequest $request, Audiomaterial $audiomaterial)
    {
        $ids = $request->input('data.*.id');
        $audiomaterial->tags()->sync($ids);

        return response(null, 204);
    }
}
