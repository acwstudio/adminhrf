<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentBookmarksUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkIdentifierResource;
use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentBookmarksRelationshipsController extends Controller
{
    /**
     * @param Document $document
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Document $document)
    {
        return AdminBookmarkIdentifierResource::collection($document->bookmarks);
    }

    public function update(DocumentBookmarksUpdateRelationshipsRequest $request, Document $document)
    {
        return response('Обновление закладок для документа отключено', 405);
    }
}
