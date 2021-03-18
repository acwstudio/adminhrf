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

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorCreateRequest $request)
    {
        $data = $request->validated();

        $author = Author::create($data['data']);

        return (new AuthorResource($author))
            ->response()
            ->header('Location', route('authors.show', [
                'author' => $author
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorUpdateRequest $request
     * @param Author $author
     * @return AuthorResource
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
//        $author->update(['slug' => '']);

        $data = $request->validated();

        $author->update($data['data']);

        return new AuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, 204);
    }
}
