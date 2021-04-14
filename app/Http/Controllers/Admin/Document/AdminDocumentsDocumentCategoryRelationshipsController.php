<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentsDocumentCategoryUpdateRelationshipsRequest;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryIdentifierResource;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentsDocumentCategoryRelationshipsController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentsDocumentCategoryRelationshipsController extends Controller
{
    /**
     * @param Document $document
     * @return AdminDocumentCategoryIdentifierResource
     */
    public function index(Document $document)
    {
        return new AdminDocumentCategoryIdentifierResource($document->category);
    }

    /**
     * @param DocumentsDocumentCategoryUpdateRelationshipsRequest $request
     * @param Document $document
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(DocumentsDocumentCategoryUpdateRelationshipsRequest $request, Document $document)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $item) {
            $documentCategory = DocumentCategory::find($item);
            $document->category()->associate($documentCategory)->save();
        }

        return response(null, 204);
    }
}
