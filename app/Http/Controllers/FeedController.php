<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Biography;
use App\Models\News;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FeedController extends Controller
{
    protected $map = [
        'read/articles',
        'read/biographies',
        'read/news',
        'tests'.
        'watch/lectures',
        'timeline'
    ];

    protected $perPage = 50;
    public function rss(Request $request) {
        $perPage = $request->get('per_page',$this->perPage);
        $page = $request->get('page', 1);
        $type = 'Статьи';
        $articles = Article::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
	    ->where('show_in_rss', '=', true)
	    ->where('active', '=', true)
            ->forPage($page,$perPage)->get();

        return response()->view('feed.rss', [
            'articles' => $articles,
            'page' => $page,
            'type' => $type,
	    'url' => 'read/articles',
        ])->header('Content-Type', 'text/xml');
    }

    public function turboArticles(Request $request) {
        $perPage = $request->get('per_page',$this->perPage);
        $url = $request->get('url','read/articles');
        $page = $request->get('page', 1);
        $type = 'Статьи';
        $entities = Article::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
            ->where('active', '=', true)
            ->forPage($page,$perPage)->get();
        return response()->view('feed.turbo-articles', [
            'articles' => $entities,
            'url' => 'read/articles',
            'page' => $page,
            'type' => $type
        ])->header('Content-Type', 'text/xml');
    }

    public function turboAfisha(Request $request){

    }

    public function turboNews(Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        $page = $request->get('page', 1);
        $type = 'Новости';
        $news = News::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
            ->where('active', '=', true)
	    ->where('show_in_rss', '=', true)
            ->forPage($page,$perPage)->get();
        return response()->view('feed.turbo-news', [
            'news' => $news,
            'url' => 'read/news',
            'page' => $page,
            'type' => $type
        ])->header('Content-Type', 'text/xml');
    }

    public function turboBiographies(Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        $url = $request->get('url','read/articles');
        $page = $request->get('page', 1);
        $type = 'Биографии';
        $biographies = Biography::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
            ->where('active', '=', true)
            ->forPage($page,$perPage)->get();
        return response()->view('feed.turbo-biographies', [
            'biographies' => $biographies,
            'url' => 'read/biographies',
            'page' => $page,
            'type' => $type
        ])->header('Content-Type', 'text/xml');
    }

    public function turboTimeline(Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        $url = $request->get('url','read/articles');
        $page = $request->get('page', 1);
        $type = 'Лента времени';
        $lowerBound = Carbon::createFromDate($request->get('start_year', 1880))->startOfMonth()->startOfDay()->format('Y-m-d');
        $upperBound = Carbon::createFromDate($request->get('end_year', 2000))->endOfMonth()->endOfDay()->format('Y-m-d');
        $timeline = Timeline::where('date', '>', $lowerBound)
            ->where('date', '<', $upperBound)->where('timelinable_type','=','article')->orderBy('date', 'asc')->paginate(100);
        return response()->view('feed.turbo-timeline', [
            'timeline' => $timeline,
            'url' => 'timeline',
            'page' => $page,
            'type' => $type
        ])->header('Content-Type', 'text/xml');
    }


}
