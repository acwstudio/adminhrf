<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleSearchResource;
use App\Models\Article;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Search\AllContent; //

class SearchController extends Controller
{
    public function search($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $model= $request->get('model', 'article');
        if($model=='article')
        {
            return ArticleSearchResource::collection(Article::where('active','=',true)->search($query)->orderBy('published_at', 'desc')->paginate($perPage)); //->union()
        }
        elseif($model =='test'){
            return TestSearchController::collection(Article::search($query)->orderBy('published_at', 'desc')->paginate($perPage))
        }

    }
}
