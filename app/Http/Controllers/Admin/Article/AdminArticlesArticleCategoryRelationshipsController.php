<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticlesArticleCategoryRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminArticleCategoryIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesArticleCategoryRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesArticleCategoryRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return AdminArticleCategoryIdentifierResource
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
            $article->category()->associate($item)->save();
        }

        return response(null, 204);
    }
}
