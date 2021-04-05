<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use MeiliSearch\Endpoints\Indexes;

class SearchController extends Controller
{
    public function search(string $str,Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        return Article::search($str, function(Indexes $meilisearch, $query, $options) use ($perPage) {
            $options['filters'] = ['active=true'];

            return  $meilisearch->search($query,$options)->paginate($perPage);
        })->get();

    }
}
