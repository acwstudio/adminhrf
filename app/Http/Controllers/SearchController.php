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

        /*        return Article::search($str, function(Indexes $meilisearch, $query, $options) use ($perPage) {
                    $options['filters'] = ['active=true'];

                    return  $meilisearch->search($query,$options);  //->paginate($perPage);
                })->paginate($perPage); */
//        $tests=Test::search($query)->orderBy('published_at', 'desc');

//        Article::search($query)->orderBy('published_at', 'desc')->union($tests);
        return ArticleSearchResource::collection(Article::search($query)->orderBy('published_at', 'desc')->paginate($perPage)); //->union()

    }
}
