<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastsBookmarksRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminBookmarkIdentifierResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastsBookmarksRelationshipsController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastsBookmarksRelationshipsController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Podcast $podcast)
    {
        return AdminBookmarkIdentifierResource::collection($podcast->bookmarks);
    }

    public function update(PodcastsBookmarksRelationshipsUpdateRequest $request, Podcast $podcast)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
