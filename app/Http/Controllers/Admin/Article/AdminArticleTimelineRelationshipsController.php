<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleTimelineUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminTimelineIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleTimelineRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleTimelineRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return AdminTimelineIdentifierResource
     */
    public function index(Article $article)
    {
        return new AdminTimelineIdentifierResource($article->timeline);
    }

    /**
     * @param ArticleTimelineUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleTimelineUpdateRelationshipsRequest $request, Article $article)
    {
        return response('обновление таймлайн статьи отключено', 405);
    }
}
