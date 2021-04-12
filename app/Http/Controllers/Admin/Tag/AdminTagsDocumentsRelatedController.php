<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Document\AdminDocumentCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsDocumentsRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsDocumentsRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return \App\Http\Resources\Admin\Document\AdminDocumentCollection
     */
    public function index(Tag $tag)
    {
        return new AdminDocumentCollection($tag->documents);
    }
}
