<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminArticlesIdentifireResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleImagesRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminArticlesIdentifireResource::collection($article->images);
    }

    public function update(Request $request, Article $article)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
