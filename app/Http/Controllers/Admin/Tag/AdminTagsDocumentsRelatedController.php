<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminDocumentCollection;
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
     * @return AdminDocumentCollection
     */
    public function index(Tag $tag)
    {
        return new AdminDocumentCollection($tag->documents);
    }
}
