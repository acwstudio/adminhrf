<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Audiomaterial;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminAudiomaterialImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Audiomaterial
 */
class AdminAudiomaterialImagesRelationshipsController extends Controller
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
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Audiomaterial $audiomaterial)
    {
        return AdminImagesIdentifierResource::collection($audiomaterial->images);
    }

    /**
     * @param AudiomaterialImagesUpdateRelationshipsRequest $request
     * @param Audiomaterial $audiomaterial
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AudiomaterialImagesUpdateRelationshipsRequest $request, Audiomaterial $audiomaterial)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($audiomaterial, $Ids, 'audiomaterial');
    }

}
