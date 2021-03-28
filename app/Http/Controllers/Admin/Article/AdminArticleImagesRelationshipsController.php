<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class AdminArticleImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleImagesRelationshipsController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Wait please, I am doing nothing now']);
    }

    public function update(Request $request, Article $article)
    {
        return response()->json(['message' => 'Wait please, I am doing nothing now']);
    }
}
