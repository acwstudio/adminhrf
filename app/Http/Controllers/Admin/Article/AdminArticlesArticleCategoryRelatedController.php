<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticleCategoryResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesArticleCategoryRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesArticleCategoryRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminArticleCategoryResource
     */
    public function index(Article $article)
    {
        return new AdminArticleCategoryResource($article->category);
    }
}
