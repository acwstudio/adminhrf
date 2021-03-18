<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Http\Resources\Admin\AdminArticleResource;
use App\Models\Article;

class AdminArticleController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return AdminArticleCollection
     */
    public function index()
    {
        return new AdminArticleCollection(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleCreateRequest $request)
    {
        $data = $request->validated();

        $article = Article::create($data['data']);

        return (new AdminArticleResource($article))
            ->response()
            ->header('Location', route('admin.articles.show', [
                'article' => $article
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return AdminArticleResource
     */
    public function show(Article $article)
    {
        return new AdminArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return AdminArticleResource
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->validated();
        $article->update($data['data']);

        return new AdminArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response(null, 204);
    }
}
