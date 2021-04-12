<?php

namespace App\Http\Controllers\Admin\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategory\ArticleCategoryArticlesRelationshipsUpdateRequest;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Models\Article;
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
        return AdminArticleIdentifireResource::collection($articleCategory->articles);
    }

    /**
     * @param ArticleCategoryArticlesRelationshipsUpdateRequest $request
     * @param ArticleCategory $articleCategory
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        ArticleCategoryArticlesRelationshipsUpdateRequest $request,
        ArticleCategory $articleCategory)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $id) {
            $article = Article::find($id);
            $articleCategory->articles()->save($article);
        }

        return response(null, 204);
    }
}
