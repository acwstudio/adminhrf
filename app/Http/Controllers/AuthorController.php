<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 8);

        $query = Author::withCount('articles')->orderBy('articles_count', 'desc');

        if (config('cache.enabled')) {

            $result = Cache::tags(['authors'])
                ->remember("query-{$request->fullUrl()}", $this->cacheTime, function () use ($query, $perPage) {
                    return $query->paginate($perPage);
                });

            if (!$request->user()) {

                return Cache::tags(['authors'])
                    ->remember("resource-{$request->fullUrl()}", $this->cacheTime, function () use ($result) {
                        return AuthorResource::collection($result);
                    });
            }

        } else {

            $result = $query->paginate($perPage);
        }

        return AuthorResource::collection($result);
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return AuthorResource
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function getArticles(Request $request, Author $author)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $author->articles()->where('active', true)
            ->where('published_at', '<', now())
            ->with(['images', 'authors']);

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
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
}
