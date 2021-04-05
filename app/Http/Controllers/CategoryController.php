<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryArticleShortResource;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        return CategoryArticleShortResource::collection(ArticleCategory::all());
    }
}
