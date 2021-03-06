<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\ArticleResource;
use App\Http\Resources\Site\NewsResource;
use App\Http\Resources\Site\NewsShortResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function getNews($tagId, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return NewsShortResource::collection(Tag::findOrFail($tagId)->news()->paginate($perPage));
    }

    public function getArticles($tagId, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return ArticleResource::collection(Tag::findOrFail($tagId)->articles()->paginate($perPage));
    }

    public function getAll($tagId, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $news = NewsResource::collection(Tag::findOrFail($tagId)->news()->orderBy('updated_at', 'desc')->paginate($perPage));
        $articles = ArticleResource::collection(Tag::findOrFail($tagId)->articles()->orderBy('published_at', 'desc')->paginate($perPage));
        return $news->merge($articles);
    }

    public function getStaff()
    {

    }

}
