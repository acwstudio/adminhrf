<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleCommentsRelatedController
 * @package App\Http\Controllers\Admin
 */
class AdminArticleCommentsRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminCommentCollection
     */
    public function index(Article $article)
    {
        return new AdminCommentCollection($article->comments);
    }
}
