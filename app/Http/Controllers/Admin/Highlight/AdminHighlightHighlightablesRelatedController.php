<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Bookmark\AdminBookmarkCollection;
use App\Http\Resources\Admin\AdminHighlightableResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightHighlightablesRelatedController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightHighlightablesRelatedController extends Controller
{
    /**
     * @param Highlight $highlight
     */
    public function index(Highlight $highlight)
    {
        return AdminHighlightableResource::collection($highlight->highlightable);
    }
}
