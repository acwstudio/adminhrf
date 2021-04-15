<?php

namespace App\Http\Controllers\Admin\DocumentCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentCategory\DocumentCategoryDocumentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Document\AdminDocumentsIdentifireResource;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentCategoryDocumentsRelationshipsController
 * @package App\Http\Controllers\Admin\DocumentCategory
 */
class AdminDocumentCategoryDocumentsRelationshipsController extends Controller
{
    /**
     * @param DocumentCategory $documentCategory
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(DocumentCategory $documentCategory)
    {
        return AdminDocumentsIdentifireResource::collection($documentCategory->documents);
    }

    /**
     * @param DocumentCategoryDocumentsUpdateRelationshipsRequest $request
     * @param DocumentCategory $documentcategory
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(
        DocumentCategoryDocumentsUpdateRelationshipsRequest $request, DocumentCategory $documentcategory)
    {
        $ids = $request->input('data.*.id');
        $documentcategory->documents()->sync($ids);

        return response(null, 204);
    }
}
