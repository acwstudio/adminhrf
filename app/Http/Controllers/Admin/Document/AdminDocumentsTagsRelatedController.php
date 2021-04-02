<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTagCollection;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentsTagsRelatedController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentsTagsRelatedController extends Controller
{
    /**
     * @param Document $document
     * @return AdminTagCollection
     */
    public function index(Document $document)
    {
        return new AdminTagCollection($document->tags);
    }
}
