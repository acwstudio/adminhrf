<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsNewsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\News\AdminNewsCollection;
use App\Http\Resources\Admin\News\AdminNewsIdentifireResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsNewsRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsNewsRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminNewsIdentifireResource::collection($tag->news);
    }

    /**
     * @param TagsNewsUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagsNewsUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
