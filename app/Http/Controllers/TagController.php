<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\NewsResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function getNews($tagId,Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        return NewsResource::collection(Tag::find($tagId)->news()->paginate($perPage));
    }

    public function getArticles($tagId, Request $request){
        $perPage = $request->get('per_page',$this->perPage);
        return ArticleResource::collection(Tag::find($tagId)->articles()->paginate($perPage));
    }

    public function getAll($tagId, Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $news = NewsResource::collection(Tag::find($tagId)->news()->paginate($perPage));
        $articles = ArticleResource::collection(Tag::find($tagId)->articles()->paginate($perPage));

    }



}
