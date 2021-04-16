<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsAudiomaterialsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialIdentifierResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsAudiomaterialsRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsAudiomaterialsRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminAudiomaterialIdentifierResource::collection($tag->audiomaterials);
    }

    /**
     * @param TagsAudiomaterialsUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TagsAudiomaterialsUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response('обновление тегов аудиоматериалов отключено', 405);
    }
}
