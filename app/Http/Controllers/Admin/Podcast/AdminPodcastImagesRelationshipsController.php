<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastImagesRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Podcast\AdminPodcastResource;
use App\Models\Image;
use App\Models\Podcast;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminPodcastImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastImagesRelationshipsController extends Controller
{
    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminTestImagesRelationshipsController constructor.
     * @param ImageAssignmentService $imageAssignment
     */
    public function __construct(ImageAssignmentService $imageAssignment)
    {
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * @param Podcast $podcast
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Podcast $podcast)
    {
        return AdminImagesIdentifierResource::collection($podcast->images);
    }

    /**
     * @param PodcastImagesRelationshipsUpdateRequest $request
     * @param Podcast $podcast
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PodcastImagesRelationshipsUpdateRequest $request, Podcast $podcast)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($podcast, $Ids, 'podcast');
    }

}

