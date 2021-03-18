<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\Admin\AdminAuthorCollection;
use App\Http\Resources\Admin\AdminAuthorResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminAuthorCollection
     */
    public function index()
    {
        return new AdminAuthorCollection(Author::all());
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

        return (new AdminAuthorResource($author))
            ->response()
            ->header('Location', route('authors.show', [
                'author' => $author
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return AdminAuthorResource
     */
    public function show(Author $author)
    {
        return new AdminAuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AuthorUpdateRequest $request
     * @param Author $author
     * @return AdminAuthorResource
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $data = $request->validated();
        $author->update($data['data']);

        return new AdminAuthorResource($author);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, 204);
    }
}
