<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesCommentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCommentsRelationshipsController
 * @package App\Http\Controllers\Admin
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
     * @param ArticlesCommentsUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticlesCommentsUpdateRelationshipsRequest $request, Article $article)
    {
        return response()->json(['message' => 'It is not ready']);
    }
}
