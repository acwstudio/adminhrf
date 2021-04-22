<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticlesArticleCategoryUpdateRelationshipsRequest;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryIdentifierResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesArticleCategoryRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesArticleCategoryRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryIdentifierResource
     */
    public function index(Article $article)
    {
        return new AdminArticleCategoryIdentifierResource($article->category);
    }

    /**
     * @param ArticlesArticleCategoryUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ArticlesArticleCategoryUpdateRelationshipsRequest $request, Article $article)
    {
        $id = $request->input('data.id');

        $article->update(['category_id' => $id]);

        return response(null, 204);
    }
}
