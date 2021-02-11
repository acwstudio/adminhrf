<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{


    /**
     * @OA\Get(
     *     path="/articles",
     *     operationId="articlesAll",
     *     tags={"Articles"},
     *     summary="Display a listing of the resource",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="The page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Everything is fine",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *
     *         )
     *     ),
     * )
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
