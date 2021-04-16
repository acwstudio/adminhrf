<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Models\Audiomaterial;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialBookmarksRelatedController extends Controller
{
    /**
     * @param Audiomaterial $audiomaterial
     * @return AdminBookmarkCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return new AdminBookmarkCollection($audiomaterial->bookmarks);
    }
}
