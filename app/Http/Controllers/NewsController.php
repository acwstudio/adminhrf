<?php

namespace App\Http\Controllers;

use App\Http\Resources\AudiomaterialResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsShortResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $announceColumns = [
        'id',
        'title',
        'slug',
        'viewed',
        'announce',
        'listorder',
        'status',
        'published_at',
        'slug',
    ];

    protected $bodyColumns = [
        'title',
        'slug',
        'body',
        'viewed',
        'show_in_main',
        'close_commentation',
        'published_at',
    ];

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

        $result = $query->orderBy('published_at', 'desc')->paginate($perPage);

        return NewsShortResource::collection($result);
    }

    public function show(News $news)
    {
        $news->increment('viewed');
        return NewsResource::make($news);
    }

    public function indexByTag(Tag $tag,Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->news()->
            where('status', true)->where('published_at', '<', now())
            ->with('images');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('viewed', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return NewsShortResource::collection($result);
    }

}
