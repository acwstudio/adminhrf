<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\Admin\AdminAuthorCollection;
use App\Http\Resources\Admin\AdminAuthorResource;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAuthorController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminAuthorCollection
     */
    public function index(Request $request)
    {
        $authors = QueryBuilder::for(Author::class)
            ->with('articles')
            ->allowedSorts(['id', 'birth_date', 'firstname'])
            ->jsonPaginate();

        return new AdminAuthorCollection($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AuthorCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $author = Author::create($data);

        return (new AdminAuthorResource($author))
            ->response()
            ->header('Location', route('admin.authors.show', [
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
        $query = QueryBuilder::for(Author::where('id', $author->id))
            ->allowedIncludes('articles')
            ->allowedFilters('firstname')
            ->firstOrFail();
//        return $query;
        return new AdminAuthorResource($query);
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
        $data = $request->input('data.attributes');

        $author->update($data);

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
