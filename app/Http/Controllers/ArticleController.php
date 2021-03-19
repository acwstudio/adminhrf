<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Guard;
use Laravel\Sanctum\Sanctum;

class ArticleController extends Controller
{

    /**
     *
     * Display paginated listing of articles.
     *
     * @param Request $request
     * @return ArticleCollection
     */

    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 16);

        return new ArticleCollection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->with('images', 'authors')
            ->orderBy('published_at', 'desc')
            ->paginate($perPage));
    }

    /**
     * Display article by id.
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return ArticleResource::make($article);
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

        return (new ArticleResource($article))
            ->response()
            ->header('Location', route('articles.show', [
                'article' => $article
            ]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ArticleUpdateRequest $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $data = $request->validated();
        $article->update($data['data']);

        return new ArticleResource($article);
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
