<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkIdentifierResource;
use App\Models\Biography;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyBookmarksRelationshipsController extends Controller
{
    /**
     * @param Biography $biography
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Biography $biography)
    {
        return AdminBookmarkIdentifierResource::collection($biography->bookmarks);
    }

    /**
     * @param BiographyBookmarksUpdateRelationshipsRequest $request
     * @param Biography $biography
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(BiographyBookmarksUpdateRelationshipsRequest $request, Biography $biography)
    {
        return response('Обновление закладок для биографии отключено', 405);
    }
}
