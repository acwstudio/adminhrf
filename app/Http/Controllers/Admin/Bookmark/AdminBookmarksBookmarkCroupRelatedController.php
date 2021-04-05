<?php

namespace App\Http\Controllers\Admin\Bookmark;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkGroupCollection;
use App\Http\Resources\Admin\AdminBookmarkGroupResource;
use App\Models\Bookmark;
use Illuminate\Http\Request;

/**
 * Class AdminBookmarksBookmarkCroupRelatedController
 * @package App\Http\Controllers\Admin\Bookmark
 */
class AdminBookmarksBookmarkCroupRelatedController extends Controller
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
