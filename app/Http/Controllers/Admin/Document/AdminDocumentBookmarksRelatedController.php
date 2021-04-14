<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentBookmarksRelatedController extends Controller
{
    /**
     * @param Document $document
     * @return AdminBookmarkCollection
     */
    public function index(Document $document)
    {
        return new AdminBookmarkCollection($document->bookmarks);
    }
}
