<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
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
     * @return \App\Http\Resources\Admin\Teg\\App\Http\Resources\Admin\Tag\AdminTagCollection
     */
    public function index(Document $document)
    {
        return new AdminTagCollection($document->tags);
    }
}
