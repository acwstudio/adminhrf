<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesTagsRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesTagsRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return \App\Http\Resources\Admin\Tag\AdminTagCollection
     */
    public function index(Article $article)
    {
        return new AdminTagCollection($article->tags);
    }
}
