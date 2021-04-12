<?php

namespace App\Http\Controllers\Admin\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryCollection;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCategoryArticlesRelatedController
 * @package App\Http\Controllers\Admin\ArticleCategory
 */
class AdminArticleCategoryArticlesRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return \App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryCollection
     */
    public function index(ArticleCategory $articleCategory)
    {
        return new AdminArticleCategoryCollection($articleCategory->articles);
    }
}
