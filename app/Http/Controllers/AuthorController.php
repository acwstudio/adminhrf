<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 8);

        return AuthorResource::collection(
            Author::withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->paginate($perPage)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return AuthorResource
     */
    public function show(Author $author)
    {
        return new AuthorResource($author);
    }
}
