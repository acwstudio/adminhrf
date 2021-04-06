<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTimelineIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleTimlineRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleTimlineRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return AdminTimelineIdentifierResource
     */
    public function index(Article $article)
    {
        return new AdminTimelineIdentifierResource($article->timeline);
    }

    public function update(Article $article)
    {
        return ['message' => 'Is not ready'];
    }
}
