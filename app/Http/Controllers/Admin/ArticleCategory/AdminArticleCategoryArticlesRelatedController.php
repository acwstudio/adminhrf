<?php

namespace App\Http\Controllers\Admin\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCategoryCollection;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCategoryArticlesRelatedController
 * @package App\Http\Controllers\Admin\ArticleCategory
 */
class AdminArticleCategoryArticlesRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminArticleCategoryCollection
     */
    public function index(Article $article)
    {
        return new AdminArticleCategoryCollection($article->category);
    }
}
