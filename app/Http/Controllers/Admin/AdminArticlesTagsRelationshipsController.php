<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminArticlesIdentifireResource;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesTagsRelationshipsController
 * @package App\Http\Controllers\Admin
 */
class AdminArticlesTagsRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminArticlesIdentifireResource::collection($article->tags);
    }

    /**
     * @param ArticlesTagsUpdateRelationshipsRequest $request
     * @param Article $article
     */
    public function update(ArticlesTagsUpdateRelationshipsRequest $request, Article $article)
    {
        return response()->json(['message' => 'It is not ready']);
    }
}
