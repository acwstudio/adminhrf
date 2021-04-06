<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTimelineResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleTimlineRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleTimlineRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminTimelineResource
     */
    public function index(Article $article)
    {
        return new AdminTimelineResource($article->timeline);
    }
}
