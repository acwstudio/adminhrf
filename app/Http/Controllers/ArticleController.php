<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{

    protected $sortParams = [
        self::SORT_POPULAR
    ];


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
        $sortBy = $request->get('sort_by');
        $category = $request->get('category');

        $query = Article::where('active', true)
            ->where('published_at', '<', now())
            ->with('images', 'authors', 'tags');

        if (!is_null($category)) {
            $query = $query->where('category_id', '=', $category);
        }
        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('viewed', 'desc');
        }

        $query = $query->orderBy('published_at', 'desc');


        if (config('cache.enabled')) {

            $result = Cache::tags(['articles'])
                ->remember("query-{$request->fullUrl()}", $this->cacheTime, function () use ($query, $perPage) {
                return $query->paginate($perPage);
            });

            if (!$request->user()) {

                return Cache::tags(['articles'])
                    ->remember("resource-{$request->fullUrl()}", $this->cacheTime, function () use ($result) {
                        return new ArticleCollection($result);
                    });
            }

        } else {

            $result = $query->paginate($perPage);
        }

        return new ArticleCollection($result);

    }

    /**
     * Display article by id.
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        $article->increment('viewed');

        return ArticleResource::make($article);
    }



    public function indexByTag(Tag $tag, Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');
        $category = $request->get('category');

        $query = $tag->articles()->where('active', true)
            ->where('published_at', '<', now())
            ->with('images');

        if (!is_null($category)) {
            $query = $query->where('category_id', '=', $category);
        }

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return new ArticleCollection($result);
    }
}
