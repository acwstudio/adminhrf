<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{


    /**
     *
     * Display a listing of the resource.
     *
     * @return ArticleCollection
     */

    public function index(Request $request)
    {
        return new ArticleCollection(Article::paginate(12));
    }
}
