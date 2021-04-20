<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleSearchResource;
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
        return Test::search($query)->orderBy('published_at', 'desc')->paginate($perPage); //->union()
    }

    public function biographies($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return Biography::search($query)->orderBy('published_at', 'desc')->paginate($perPage); //->union()
    }

    public function news($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return News::search($query)->orderBy('published_at', 'desc')->paginate($perPage); //->union()
    }

    public function highlights($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return Highlight::search($query)->orderBy('published_at', 'desc')->paginate($perPage); //->union()
    }

    public function videomaterials($query, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return Videomaterial::search($query)->orderBy('published_at', 'desc')->paginate($perPage); //->union()
    }
}
