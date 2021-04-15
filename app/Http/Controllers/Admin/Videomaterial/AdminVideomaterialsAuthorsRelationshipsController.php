<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videomaterial\VideomaterialsAuthorsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Author\AdminAuthorsIdentifireResource;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialsAuthorsRelationshipsController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialsAuthorsRelationshipsController extends Controller
{
    /**
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return AdminAuthorsIdentifireResource::collection($videomaterial->authors);
    }

    /**
     * @param VideomaterialsAuthorsUpdateRelationshipsRequest $request
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        VideomaterialsAuthorsUpdateRelationshipsRequest $request, Videomaterial $videomaterial)
    {
        $ids = $request->input('data.*.id');
        $videomaterial->authors()->sync($ids);

        return response(null, 204);
    }
}
