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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ArticlesTagsUpdateRelationshipsRequest $request, Article $article)
    {
        $ids = $request->input('data.*.id');
        $article->tags()->sync($ids);

        return response(null, 204);
    }
}
