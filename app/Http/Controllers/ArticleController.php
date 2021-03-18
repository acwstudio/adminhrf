<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

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
            ->with('images')
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
}
