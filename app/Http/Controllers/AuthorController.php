<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Article;
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

        return AuthorResource::collection(Author::withCount('articles')->orderBy('articles_count', 'desc')->paginate($perPage));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorCreateRequest $request)
    {
        $author = Author::create([
            'firstname' => $request->input('data.firstname'),
            'surname' => $request->input('data.surname'),
            'patronymic' => $request->input('data.patronymic'),
            'birth_date' => $request->input('data.birth_date'),
            'description' => $request->input('data.description'),
        ]);

        /** @var Author $author */
        $author->save();


        return (new AuthorResource($author))
            ->response()
            ->header('Location', route('authors.show', [
                'author' => $author
            ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $author->update([
            'firstname' => $request->input('data.firstname'),
            'surname' => $request->input('data.surname'),
            'patronymic' => $request->input('data.patronymic'),
            'birth_date' => $request->input('data.birth_date'),
            'description' => $request->input('data.description'),
        ]);

        $author->save();

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
