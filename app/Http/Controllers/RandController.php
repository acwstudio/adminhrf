<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\BiographyResource;
use App\Http\Resources\BiographyShortResource;
use App\Http\Resources\NewsShortResource;
use App\Models\Article;
use App\Models\Biography;
use App\Models\News;
use Illuminate\Http\Request;

class RandController extends Controller
{
    public function getRandNews(Request $request){
        $rand = $request->get('rand', 1);
        return NewsShortResource::collection(News::all()->where('published_at','<',now())->random($rand));
    }

    public function getRandArticles(Request $request){
        $rand = $request->get('rand', 1);
        return ArticleShortResource::collection(Article::all()->where('published_at','<',now())->random($rand));
    }

    public function getRandBiographies(Request $request){
        $rand = $request->get('rand', 1);
        return BiographyShortResource::collection(Biography::all()->where('published_at','<',now())->random($rand));
    }
}
