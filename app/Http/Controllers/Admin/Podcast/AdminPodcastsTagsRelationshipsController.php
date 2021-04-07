<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastsTagsRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminTagsIdentifierResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastsTagsRelationshipsController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastsTagsRelationshipsController extends Controller
{
    /**
     * @param Podcast $podcast
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Podcast $podcast)
    {
        return AdminTagsIdentifierResource::collection($podcast->tags);
    }

    /**
     * @param PodcastsTagsRelationshipsUpdateRequest $request
     * @param Podcast $podcast
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(PodcastsTagsRelationshipsUpdateRequest $request, Podcast $podcast)
    {
        $ids = $request->input('data.*.id');
        $podcast->tags()->sync($ids);

        return response(null, 204);
    }
}
