<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HighlightsTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightsTagsRelationshipsController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Highlight $highlight)
    {
        return AdminHighlightCollection::collection($highlight->tags);
    }

    /**
     * @param HighlightsTagsUpdateRelationshipsRequest $request
     * @param Highlight $highlight
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(HighlightsTagsUpdateRelationshipsRequest $request, Highlight $highlight)
    {
        $ids = $request->input('data.*.id');
        $highlight->tags()->sync($ids);

        return response(null, 204);
    }
}
