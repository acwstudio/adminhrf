<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialBookmarksRelationshipsController
 * @package App\Http\Controllers
 */
class AdminAudiomaterialBookmarksRelationshipsController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return AdminBookmarkIdentifierResource::collection($audiomaterial->bookmarks);
    }

    /**
     * @param AudiomaterialBookmarksUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        AudiomaterialBookmarksUpdateRelationshipsRequest $request, Audiomaterial $audiomaterial)
    {
        return response('Обновление закладок для аудиоматериалов отключено', 405);
    }
}
