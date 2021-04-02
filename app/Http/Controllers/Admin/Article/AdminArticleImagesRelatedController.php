<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleImagesRelatedController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleImagesRelatedController extends Controller
{
    /**
     * @param Article $article
     * @return AdminImageCollection
     */
    public function index(Article $article)
    {
        return new AdminImageCollection($article->comments);
    }
}
