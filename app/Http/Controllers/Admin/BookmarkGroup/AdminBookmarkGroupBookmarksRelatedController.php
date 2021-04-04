<?php

namespace App\Http\Controllers\Admin\BookmarkGroup;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
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
     * @return AdminBookmarkCollection
     */
    public function index(BookmarkGroup $bookmarkGroup)
    {
        return new AdminBookmarkCollection($bookmarkGroup->bookmarks);
    }
}
