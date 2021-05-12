<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ArticleShortResource;
use App\Http\Resources\Site\AudiomaterialResource;
use App\Http\Resources\Site\BiographyShortResource;
use App\Http\Resources\CourseShortResource;
use App\Http\Resources\FilmsShortResource;
use App\Http\Resources\HighlightShortResource;
use App\Http\Resources\NewsShortResource;
use App\Http\Resources\PodcastResource;
use App\Http\Resources\TestShortResource;
use App\Http\Resources\VideoLectureShortResource;
use App\Models\Article;
use App\Models\Audiomaterial;
use App\Models\Biography;
use App\Models\Highlight;
use App\Models\News;
use App\Models\Podcast;
use App\Models\Test;
use App\Models\Videomaterial;
use Illuminate\Http\Request;
use function now;

class RandController extends Controller
{
    public function getRandNews(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? NewsShortResource::collection(News::inRandomOrder()->where('published_at', '<', now())->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandArticles(Request $request)
    {
        $rand = $request->get('rand', 1);

        return $rand < 21 ? ArticleShortResource::collection(Article::inRandomOrder()->where('published_at', '<', now())->where('active', true)->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandBiographies(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? BiographyShortResource::collection(Biography::inRandomOrder()->where('published_at', '<', now())->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandVideolectures(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? VideoLectureShortResource::collection(Videomaterial::inRandomOrder()->where('published_at', '<', now())->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandAudiolectures(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? AudiomaterialResource::collection(Audiomaterial::inRandomOrder()->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandFilms(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? FilmsShortResource::collection(Videomaterial::inRandomOrder()->where('published_at', '<', now())->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandHighlights(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? HighlightShortResource::collection(Highlight::inRandomOrder()->where('published_at', '<', now())->where('type', '=', 'highlight')->where('active', true)->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::inRandomOrder()->where('published_at', '<', now())->where('type', '=', 'course')->where('active', true)->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandVideoCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::inRandomOrder()->where('published_at', '<', now())->where('type', '=', 'videocourse')->where('active', true)->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandAudioCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::inRandomOrder()->where('published_at', '<', now())->where('type', '=', 'audiocourse')->where('active', true)->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandTest(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? TestShortResource::collection(Test::inRandomOrder()->where('published_at', '<', now())->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

    public function getRandPodcasts(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? PodcastResource::collection(Podcast::inRandomOrder()->with('images')->limit($rand)->get()) : ['err' => 'nice try bro;)'];
    }

}
