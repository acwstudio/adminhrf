<?php

namespace App\Http\Controllers\Admin\Bookmark;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmark\BookmarksBookmarkGroupUpdateRelationshipsRequest;
use App\Http\Resources\Admin\BookmarkGroup\AdminBookmarkGroupIdentifierResource;
use App\Models\Bookmark;
use App\Models\BookmarkGroup;
use Illuminate\Http\Request;

/**
 * Class AdminBookmarksBookmarkGroupRelationshipsController
 * @package App\Http\Controllers\Admin\Bookmark
 */
class AdminBookmarksBookmarkGroupRelationshipsController extends Controller
{
    /**
     * @param Bookmark $bookmark
     * @return AdminBookmarkGroupIdentifierResource
     */
    public function index(Bookmark $bookmark)
    {
        return new AdminBookmarkGroupIdentifierResource($bookmark->bookmarkGroup);
    }

    /**
     * @param BookmarksBookmarkGroupUpdateRelationshipsRequest $request
     * @param Bookmark $bookmark
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(BookmarksBookmarkGroupUpdateRelationshipsRequest $request, Bookmark $bookmark)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $item) {
            $bookmarkGroup = BookmarkGroup::find($item);
            $bookmark->bookmarkGroup()->associate($bookmarkGroup)->save();
        }

        return response(null, 204);
    }
}
