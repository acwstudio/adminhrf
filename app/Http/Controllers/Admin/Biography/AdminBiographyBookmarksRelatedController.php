<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyBookmarksRelatedController extends Controller
{
    /**
     * @param Biography $biography
     * @return \App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection
     */
    public function index(Biography $biography)
    {
        return new AdminBookmarkCollection($biography->bookmarks);
    }
}
