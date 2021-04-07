<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastsBookmarksRelatedController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastsBookmarksRelatedController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return AdminBookmarkCollection
     */
    public function index(Podcast $podcast)
    {
        return new AdminBookmarkCollection($podcast->bookmarks);
    }
}
