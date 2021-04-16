<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsHighlightsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminHighlightsIdentifierResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsHighlightsRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsHighlightsRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminHighlightsIdentifierResource::collection($tag->highlights);
    }

    /**
     * @param TagsHighlightsUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TagsHighlightsUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response('обновление тега для связанных highlights отключено', 405);
    }
}
