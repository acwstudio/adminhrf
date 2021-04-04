<?php

namespace App\Http\Controllers\Admin\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCategoryArticlesRelationshipsController
 * @package App\Http\Controllers\Admin\ArticleCategory
 */
class AdminArticleCategoryArticlesRelationshipsController extends Controller
{
    /**
     * @param ArticleCategory $articleCategory
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ArticleCategory $articleCategory)
    {
        return ;
    }
}
