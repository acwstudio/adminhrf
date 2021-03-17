<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\BookmarkShortResource;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsShortResource;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use OpenApi\Tests\Fixtures\NestedProperty;

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


    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return NewsShortResource::collection(News::where('status', true)->where('published_at','<',now())->orderBy('published_at','desc')->paginate($perPage));
    }

    public function show(News $news)
    {
        return NewsResource::make($news);
    }





}
