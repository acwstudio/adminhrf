<?php

namespace App\Http\Controllers\Admin\BookmarkGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkGroup\BookmarkGroupBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
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
     * @return AdminBookmarkIdentifierResource
     */
    public function index(BookmarkGroup $bookmarkGroup)
    {
        return new AdminBookmarkIdentifierResource($bookmarkGroup->bookmarks);
    }

    /**
     * @param BookmarkGroup $bookmarkGroup
     */
    public function update(
        BookmarkGroupBookmarksUpdateRelationshipsRequest $request,
        BookmarkGroup $bookmarkGroup)
    {
        $ids = $bookmarkGroup->bookmarks;
    }
}
