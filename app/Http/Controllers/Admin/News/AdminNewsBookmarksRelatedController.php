<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsBookmarksRelatedController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsBookmarksRelatedController extends Controller
{
    /**
     * @param News $news
     * @return AdminBookmarkCollection
     */
    public function index(News $news)
    {
        return new AdminBookmarkCollection($news->bookmarks);
    }
}
