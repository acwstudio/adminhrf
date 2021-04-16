<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class AdminTagsHighlightsRelatedController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagsHighlightsRelatedController extends Controller
{
    /**
     * @param Tag $tag
     * @return AdminHighlightCollection
     */
    public function index(Tag $tag)
    {
        return new AdminHighlightCollection($tag->highlights);
    }
}
