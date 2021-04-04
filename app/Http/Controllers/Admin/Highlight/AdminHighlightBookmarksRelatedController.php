<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightBookmarksRelatedController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return AdminBookmarkCollection
     */
    public function index(Highlight $highlight)
    {
        return new AdminBookmarkCollection($highlight->bookmarks);
    }
}
