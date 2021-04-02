<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminAuthorCollection;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesAuthorsRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesAuthorsRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminAuthorCollection
     */
    public function index(Article $article)
    {
        return new AdminAuthorCollection($article->authors);
    }
}
