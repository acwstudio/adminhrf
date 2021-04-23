<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleBookmarksRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return \App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection
     */
    public function index(Article $article)
    {
        return new AdminBookmarkCollection($article->bookmarks);
    }
}
