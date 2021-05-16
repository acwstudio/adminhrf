<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\NewsResource;
use App\Http\Resources\Site\NewsShortResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use function config;
use function now;

class NewsController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];


    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $sortBy = $request->get('sort_by');

        $query = News::where('status', true)->where('published_at', '<', now());

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('viewed', 'desc');
        }

        $query = $query->orderBy('published_at', 'desc');

        if (config('cache.enabled')) {

            $result = Cache::tags(['news'])
                ->remember("query-{$request->fullUrl()}", $this->cacheTime, function () use ($query, $perPage) {
                    return $query->paginate($perPage);
                });

            if (!$request->user()) {

                return Cache::tags(['news'])
                    ->remember("resource-{$request->fullUrl()}", $this->cacheTime, function () use ($result) {
                        return NewsShortResource::collection($result);
                    });
            }

        } else {

            $result = $query->paginate($perPage);
        }

        return NewsShortResource::collection($result);
    }

    public function show(News $news)
    {
        $news->increment('viewed');
        return NewsResource::make($news);
    }

    public function indexByTag(Tag $tag, Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->news()
            ->where('status', true)
            ->where('published_at', '<', now())
            ->with('images');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('viewed', 'desc');
        }

        $query = $query->orderBy('published_at', 'desc');

        if (config('cache.enabled')) {

            $result = Cache::tags(['news'])
                ->remember("query-{$request->fullUrl()}", $this->cacheTime, function () use ($query, $perPage) {
                    return $query->paginate($perPage);
                });

            if (!$request->user()) {

                return Cache::tags(['news'])
                    ->remember("resource-{$request->fullUrl()}", $this->cacheTime, function () use ($result) {
                        return NewsShortResource::collection($result);
                    });
            }

        } else {

            $result = $query->paginate($perPage);
        }

        return NewsShortResource::collection($result);
    }

}
