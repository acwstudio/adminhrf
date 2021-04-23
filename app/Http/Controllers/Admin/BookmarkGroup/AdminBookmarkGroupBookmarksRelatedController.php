<?php

namespace App\Http\Controllers\Admin\BookmarkGroup;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection;
use App\Models\BookmarkGroup;
use Illuminate\Http\Request;

/**
 * Class AdminBookmarkGroupBookmarksRelatedController
 * @package App\Http\Controllers\Admin\BookmarkGroup
 */
class AdminBookmarkGroupBookmarksRelatedController extends Controller
{
    /**
     * @param BookmarkGroup $bookmarkGroup
     * @return \App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection
     */
    public function index(BookmarkGroup $bookmarkGroup)
    {
        return new AdminBookmarkCollection($bookmarkGroup->bookmarks);
    }
}
