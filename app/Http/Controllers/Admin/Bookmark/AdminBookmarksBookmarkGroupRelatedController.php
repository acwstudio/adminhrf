<?php

namespace App\Http\Controllers\Admin\Bookmark;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkGroupCollection;
use App\Http\Resources\Admin\AdminBookmarkGroupResource;
use App\Models\Bookmark;
use Illuminate\Http\Request;

/**
 * Class AdminBookmarksBookmarkGroupRelatedController
 * @package App\Http\Controllers\Admin\Bookmark
 */
class AdminBookmarksBookmarkGroupRelatedController extends Controller
{
    /**
     * @param Bookmark $bookmark
     * @return AdminBookmarkGroupResource
     */
    public function index(Bookmark $bookmark)
    {
        return new AdminBookmarkGroupResource($bookmark->bookmarkGroup);
    }
}
