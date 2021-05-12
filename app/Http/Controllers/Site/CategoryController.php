<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\CategoryArticleShortResource;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return CategoryArticleShortResource::collection(ArticleCategory::where('count','>',10)->get()); //where('count','>',10));
    }
}
