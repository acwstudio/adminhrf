<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialsHighlightsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminHighlightsIdentifierResource;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialsHighlightsRelationshipsController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialsHighlightsRelationshipsController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return AdminHighlightsIdentifierResource::collection($audiomaterial->highlights);
    }

    /**
     * @param AudiomaterialsHighlightsUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AudiomaterialsHighlightsUpdateRelationshipsRequest $request,
                           Audiomaterial $audiomaterial)
    {
        $ids = $request->input('data.*.id');
        $audiomaterial->highlights()->sync($ids);

        return response(null, 204);
    }
}
