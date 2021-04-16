<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsVideomaterialsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsVideomaterialsRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsVideomaterialsRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminVideomaterialCollection::collection($tag->videomaterials);
    }

    /**
     * @param TagsVideomaterialsUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TagsVideomaterialsUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response('обновление тегов видеоматериалов отключено', 405);
    }
}
