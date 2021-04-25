<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleTimelineUpdateRelationshipsRequest;
use App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource;
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
     * @return \App\Http\Resources\Admin\TimeLine\AdminTimelineIdentifierResource
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
        $timelineDate = $request->input('data.attributes.date');

        $article->timeline()->update([
            'date' => $timelineDate,
        ]);
    }
}
