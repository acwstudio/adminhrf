<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleSearchResource;
use App\Http\Resources\BiographySearchResource;
use App\Http\Resources\NewsSearchResource;
use App\Http\Resources\TestSearchResource;
use App\Http\Resources\VideomaterialSearchResource;
use App\Models\Article;
use App\Models\Biography;
use App\Models\Highlight;
use App\Models\News;
use App\Models\Test;
use App\Models\Videomaterial;
use Illuminate\Http\Request;
use App\Search\AllContent; //

class SearchController extends Controller
{
    public function articles($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return ArticleSearchResource::collection(Article::search($query)->orderBy('published_at', 'desc')->paginate($perPage)); //->union()
    }

    public function tests($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return TestSearchResource::collection(Test::search($query)->orderBy('published_at', 'desc')->paginate($perPage)); //->union()
    }

    public function biographies($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return BiographySearchResource::collection(Biography::search($query)->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function news($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return NewsSearchResource::collection(News::search($query)->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function highlights($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return Highlight::search($query)->orderBy('published_at', 'desc')->paginate($perPage);
    }

    public function videomaterials($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return VideomaterialSearchResource::collection(Videomaterial::search($query)->orderBy('published_at', 'desc')->paginate($perPage));
    }
}
