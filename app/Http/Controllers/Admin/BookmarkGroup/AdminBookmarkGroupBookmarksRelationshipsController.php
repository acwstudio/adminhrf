<?php

namespace App\Http\Controllers\Admin\BookmarkGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkGroup\BookmarkGroupBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkIdentifierResource;
use App\Models\Bookmark;
use App\Models\BookmarkGroup;
use Illuminate\Http\Request;

/**
 * Class AdminBookmarkGroupBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\BookmarkGroup
 */
class AdminBookmarkGroupBookmarksRelationshipsController extends Controller
{
    /**
     * @param BookmarkGroup $bookmarkGroup
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(BookmarkGroup $bookmarkGroup)
    {
        return AdminBookmarkIdentifierResource::collection($bookmarkGroup->bookmarks);
    }

    /**
     * @param BookmarkGroup $bookmarkGroup
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        BookmarkGroupBookmarksUpdateRelationshipsRequest $request,
        BookmarkGroup $bookmarkGroup)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $id) {
            $bookmark = Bookmark::find($id);
            $bookmarkGroup->bookmarks()->save($bookmark);
        }

        return response(null, 204);
    }
}
