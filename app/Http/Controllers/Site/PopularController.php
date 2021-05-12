<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ArticleCollection;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function now;

class PopularController extends Controller
{
    public function articles(Request $request)
    {
        $qty = $request->get('qty', 6);

        return new ArticleCollection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->with('images')
            ->orderBy('commented', 'desc')
            ->take($qty)
            ->get());

    }

    public function comments(Request $request)
    {
        $qty = $request->get('qty', 10);


        $comments = Comment::with('user')
            ->where('type','=','comment')
            ->whereNull('parent_id')
            ->aproved()
            ->latest()
            ->take($qty)
            ->get();

        return CommentResource::collection($comments);


    }

    public function reviews(Request $request)
    {
        $qty = $request->get('qty', 10);

        $comments = Comment::with('user')
            ->where('type','=','review')
            ->aproved()
            ->latest()
            ->take($qty)
            ->get();

        return CommentResource::collection($comments);


    }
}
