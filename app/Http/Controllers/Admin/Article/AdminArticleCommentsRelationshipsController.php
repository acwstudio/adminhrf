<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCommentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCommentsRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleCommentsRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminCommentsIdentifierResource::collection($article->comments);
    }

    /**
     * @param \App\Http\Requests\Article\ArticleCommentsUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleCommentsUpdateRelationshipsRequest $request, Article $article)
    {
        return response()->json(['message' => 'Update comments action for article is disabled']);
    }
}
