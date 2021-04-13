<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentImagesRelatedController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentImagesRelatedController extends Controller
{
    /**
     * @param Document $document
     * @return AdminImageCollection
     */
    public function index(Document $document)
    {
        return new AdminImageCollection($document->images);
    }
}
