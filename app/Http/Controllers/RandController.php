<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\AudiomaterialResource;
use App\Http\Resources\BiographyShortResource;
use App\Http\Resources\CourseShortResource;
use App\Http\Resources\FilmsShortResource;
use App\Http\Resources\HighlightResource;
use App\Http\Resources\HighlightShortResource;
use App\Http\Resources\NewsShortResource;
use App\Http\Resources\TestShortResource;
use App\Http\Resources\VideoLectureShortResource;
use App\Models\Article;
use App\Models\Audiomaterial;
use App\Models\Biography;
use App\Models\Highlight;
use App\Models\News;
use App\Models\Test;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

class RandController extends Controller
{
    public function getRandNews(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? NewsShortResource::collection(News::all()->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandArticles(Request $request)
    {
        $rand = $request->get('rand', 1);

        return $rand < 21 ? ArticleShortResource::collection(Article::all()->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandBiographies(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? BiographyShortResource::collection(Biography::all()->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandVideolectures(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? VideoLectureShortResource::collection(Videomaterial::all()->where('type','=','lecture')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandAudiolectures(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? AudiomaterialResource::collection(Audiomaterial::all()->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandFilms(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? FilmsShortResource::collection(Videomaterial::all()->where('type','=','film')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandHighlights(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? HighlightShortResource::collection(Highlight::all()->where('type','=','highlight')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::all()->where('type','=','course')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandVideoCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::all()->where('type','=','videocourse')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandAudioCourses(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? CourseShortResource::collection(Highlight::all()->where('type','=','audiocourse')->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

    public function getRandTest(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? TestShortResource::collection(Test::all()->where('published_at', '<', now())->random($rand)->with('images')) : ['err' => 'nice try bro;)'];
    }

}
