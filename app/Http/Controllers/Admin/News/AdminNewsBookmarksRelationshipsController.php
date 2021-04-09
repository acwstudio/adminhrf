<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsBookmarksRelationshipsController extends Controller
{
    /**
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminBookmarkIdentifierResource::collection($news->bookmarks);
    }

    public function update()
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
