<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Http\Resources\Admin\AdminHighlightResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightsTagsRelatedController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightsTagsRelatedController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return AdminHighlightCollection
     */
    public function index(Highlight $highlight)
    {
        return new AdminHighlightCollection($highlight->tags);
    }
}
