<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    /**
     *
     * Display paginated listing of articles.
     *
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
     * @param  Article  $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $Article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $Article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $Article)
    {
        //
    }
}
