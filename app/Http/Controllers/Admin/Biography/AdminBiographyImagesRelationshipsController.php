<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Biography;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminBiographyImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyImagesRelationshipsController extends Controller
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
     * @param Biography $biography
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Biography $biography)
    {
        return AdminImagesIdentifierResource::collection($biography->images);
    }

    /**
     * @param BiographyImagesUpdateRelationshipsRequest $request
     * @param Biography $biography
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BiographyImagesUpdateRelationshipsRequest $request, Biography $biography)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($biography, $Ids, 'biography');
    }
}
