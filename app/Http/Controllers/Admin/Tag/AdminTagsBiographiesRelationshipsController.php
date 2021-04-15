<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsBiographiesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Biography\AdminBiographiesIdentifireResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsBiographiesRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsBiographiesRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminBiographiesIdentifireResource::collection($tag->biographies);
    }

    /**
     * @param TagsBiographiesUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagsBiographiesUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
