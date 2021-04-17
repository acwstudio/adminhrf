<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HighlightBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightHighlightablesRelationshipsController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightHighlightablesRelationshipsController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Highlight $highlight)
    {
        return AdminBookmarkIdentifierResource::collection($highlight->bookmarks);
    }

    /**
     * @param HighlightBookmarksUpdateRelationshipsRequest $request
     * @param Highlight $highlight
     * @return mixed
     */
    public function update(HighlightBookmarksUpdateRelationshipsRequest $request, Highlight $highlight)
    {
        return $highlight->bookmarks;
    }
}
