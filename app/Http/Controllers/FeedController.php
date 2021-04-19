<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function turbo() {
        $articles = Article::orderBy('created_at', 'desc')
            ->where('published_at', '<', now())
            ->paginate(15);
//        $randoms = Article::orderBy(DB::raw('RAND()'))
//            ->where('published_at', '<', now())
//            ->paginate(5);

        return response()->view('feed.rss', [
            'articles' => $articles,
           // 'randoms' => $randoms
        ])->header('Content-Type', 'text/xml');
    }
}
