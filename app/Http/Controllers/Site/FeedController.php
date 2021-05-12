<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Biography;
use App\Models\News;
use App\Models\Timeline;
use App\Models\Videomaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function now;
use function response;

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

    protected $perPage = 100;
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
            'type' => $type,
            'rand' => 'https://histrf.ru/read/articles'.Article::all()->where('active','=',true)->random(1)->first()->slug,
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
            ->where('status', '=', true)
	        ->where('show_in_rss', '=', true)
            ->forPage($page,$perPage)->get();
        return response()->view('feed.turbo-news', [
            'news' => $news,
            'url' => 'read/news',
            'page' => $page,
            'type' => $type,
            'rand' => 'https://histrf.ru/read/news'.News::all()->where('status','=',true)->random(1)->first()->slug,
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
            'type' => $type,
            'rand' => Biography::all()->where('active','=',true)->random(1)->first()->slug,
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
            'type' => $type,
            //'rand' => Article::where('active','=',true)->all()->random(1)->first()->slug,
        ])->header('Content-Type', 'text/xml');
    }

    public function turboVideolectures(Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        $page = $request->get('page', 1);
        $type = 'Лекции';
        $lectures = Videomaterial::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
            ->where('type', '=', 'lecture')
            ->where('active', '=', true)
            ->where('video_code','like','%https://www.youtube.com/embed/%')
            ->forPage($page,$perPage)->get();

        return response()->view('feed.turbo-videolectures', [
            'lectures' => $lectures,
            'page' => $page,
            'type' => $type,
            'url' => 'watch/lectures',
        ])->header('Content-Type', 'text/xml');
    }

    public function turboFilms(Request $request){
        $perPage = $request->get('per_page',$this->perPage*3);
        $page = $request->get('page', 1);
        $type = 'Документальные фильмы';
        $films = Videomaterial::orderBy('published_at', 'desc')
            ->where('published_at', '<', now())
            ->where('type', '=', 'film')
            ->where('active', '=', true)
            ->where('video_code','like','%https://www.youtube.com/embed/%')
            ->forPage($page,$perPage)->get();

        return response()->view('feed.turbo-films', [
            'films' => $films,
            'page' => $page,
            'type' => $type,
            'url' => 'watch/films',
        ])->header('Content-Type', 'text/xml');
    }

}
