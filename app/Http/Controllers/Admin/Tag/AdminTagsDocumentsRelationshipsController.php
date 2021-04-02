<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagsDocumentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminDocumentsIdentifireResource;
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
        return response()->json(['message' => 'Update action is disabled']);
    }
}
