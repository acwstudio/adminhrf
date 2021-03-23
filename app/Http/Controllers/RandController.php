<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\BiographyShortResource;
use App\Http\Resources\NewsShortResource;
use App\Models\Article;
use App\Models\Biography;
use App\Models\News;
use Illuminate\Http\Request;

class RandController extends Controller
{
    public function getRandNews(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? NewsShortResource::collection(News::all()->where('published_at', '<', now())->random($rand)) : ['err' => 'nice try bro;)'];
    }

    public function getRandArticles(Request $request)
    {
        $rand = $request->get('rand', 1);

        return $rand < 21 ? ArticleShortResource::collection(Article::all()->where('published_at', '<', now())->random($rand)) : ['err' => 'nice try bro;)'];
    }

    public function getRandBiographies(Request $request)
    {
        $rand = $request->get('rand', 1);
        return $rand < 21 ? BiographyShortResource::collection(Biography::all()->where('published_at', '<', now())->random($rand)) : ['err' => 'nice try bro;)'];
    }
}
