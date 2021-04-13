<?php

namespace App\Http\Controllers\Admin\DocumentCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Document\AdminDocumentCollection;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentCategoryDocumentsRelatedController
 * @package App\Http\Controllers\Admin\DocumentCategory
 */
class AdminDocumentCategoryDocumentsRelatedController extends Controller
{
    /**
     * @param DocumentCategory $documentCategory
     * @return AdminDocumentCollection
     */
    public function index(DocumentCategory $documentCategory)
    {
        return new AdminDocumentCollection($documentCategory->documents);
    }
}
