<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorsArticlesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminArticlesIdentifireResource;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorsArticlesRelationshipsController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorsArticlesRelationshipsController extends Controller
{
    /**
     * @param Author $author
     * @return mixed
     */
    public function index(Author $author)
    {
        return AdminArticlesIdentifireResource::collection($author->articles);
    }

    /**
     * @param AuthorsArticlesUpdateRelationshipsRequest $request
     * @param Author $author
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AuthorsArticlesUpdateRelationshipsRequest $request, Author $author)
    {
        $ids = $request->input('data.*.id');
        $author->articles()->sync($ids);

        return response(null, 204);
    }
}
