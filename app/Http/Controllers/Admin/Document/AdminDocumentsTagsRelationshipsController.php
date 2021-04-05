<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentsTagsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminTagsIdentifierResource;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentsTagsRelationshipsController extends Controller
{
    /**
     * @param Document $document
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Document $document)
    {
        return AdminTagsIdentifierResource::collection($document->tags);
    }

    /**
     * @param DocumentsTagsUpdateRelationshipsRequest $request
     * @param Document $document
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(DocumentsTagsUpdateRelationshipsRequest $request, Document $document)
    {
        $ids = $request->input('data.*.id');
        $document->tags()->sync($ids);

        return response(null, 204);
    }
}
