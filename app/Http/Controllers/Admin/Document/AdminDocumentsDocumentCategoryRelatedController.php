<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryResource;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentsDocumentCategoryRelatedController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentsDocumentCategoryRelatedController extends Controller
{
    /**
     * @param Document $document
     * @return AdminDocumentCategoryResource
     */
    public function index(Document $document)
    {
        return new AdminDocumentCategoryResource($document->category);
    }
}
