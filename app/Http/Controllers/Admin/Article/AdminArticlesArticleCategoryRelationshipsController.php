<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticlesArticleCategoryRelationshipsUpdateRequest;
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
     * @param ArticlesArticleCategoryRelationshipsUpdateRequest $request
     * @param Article $article
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ArticlesArticleCategoryRelationshipsUpdateRequest $request, Article $article)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $item) {
            $articleCategory = ArticleCategory::find($item);
            $article->category()->associate($articleCategory)->save();
        }

        return response(null, 204);
    }
}
