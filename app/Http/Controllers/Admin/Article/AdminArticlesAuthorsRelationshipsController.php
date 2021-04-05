<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticlesAuthorsUpdateRelationshipsRequest;
use App\Http\Requests\Author\AuthorsArticlesUpdateRelationshipsRequest;
use App\Models\Article;
use App\Http\Resources\Admin\AdminAuthorsIdentifireResource;
use Illuminate\Http\Request;

/**
 * Class AdminArticlesAuthorsRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticlesAuthorsRelationshipsController extends Controller
{
    /**
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminAuthorsIdentifireResource::collection($article->authors);
    }

    /**
     * @param \App\Http\Requests\Article\ArticlesAuthorsUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(ArticlesAuthorsUpdateRelationshipsRequest $request, Article $article)
    {
        $ids = $request->input('data.*.id');
        $article->authors()->sync($ids);

        return response(null, 204);
    }
}
