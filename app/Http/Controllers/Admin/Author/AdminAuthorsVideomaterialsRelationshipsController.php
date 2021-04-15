<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorsVideomaterialsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialIdentifierResource;
use App\Models\Author;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorsVideomaterialsRelationshipsController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorsVideomaterialsRelationshipsController extends Controller
{
    /**
     * @param Author $author
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Author $author)
    {
        return AdminVideomaterialIdentifierResource::collection($author->video);
    }

    /**
     * @param AuthorsVideomaterialsUpdateRelationshipsRequest $request
     * @param Author $author
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AuthorsVideomaterialsUpdateRelationshipsRequest $request, Author $author)
    {
        $ids = $request->input('data.*.id');
        $author->video()->sync($ids);

        return response(null, 204);
    }
}
