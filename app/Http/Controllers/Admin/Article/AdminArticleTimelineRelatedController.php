<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TimeLine\AdminTimelineResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleTimelineRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleTimelineRelatedController extends Controller
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
