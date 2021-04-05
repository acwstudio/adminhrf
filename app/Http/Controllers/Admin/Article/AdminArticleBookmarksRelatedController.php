<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCollection;
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
     * @return AdminArticleCollection
     */
    public function index(Article $article)
    {
        return new AdminArticleCollection($article->bookmarks);
    }
}
