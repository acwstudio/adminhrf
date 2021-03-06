<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsDocumentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Document\AdminDocumentsIdentifireResource;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsDocumentsRelationshipsController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsDocumentsRelationshipsController extends Controller
{
    /**
     * @param Tag $tag
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Tag $tag)
    {
        return AdminDocumentsIdentifireResource::collection($tag->documents);
    }

    /**
     * @param TagsDocumentsUpdateRelationshipsRequest $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagsDocumentsUpdateRelationshipsRequest $request, Tag $tag)
    {
        return response('обновление тега для связанных документов отключено', 405);
    }
}
