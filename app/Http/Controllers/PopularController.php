<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function articles(Request $request)
    {
        $qty = $request->get('qty', 6);

        return new ArticleCollection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->with('images')
            ->orderBy('published_at', 'desc')
            ->take($qty)
            ->get());

    }

    public function comments(Request $request)
    {
        $qty = $request->get('qty', 10);


        $comments = Comment::with('user')
            ->whereNull('parent_id')
            ->latest()
            ->take($qty)
            ->get();

        return CommentResource::collection($comments);


    }
}
