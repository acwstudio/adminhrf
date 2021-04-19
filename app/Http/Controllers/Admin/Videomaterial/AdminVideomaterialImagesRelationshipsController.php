<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videomaterial\VideomaterialImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Image;
use App\Models\Videomaterial;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminVideomaterialImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialImagesRelationshipsController extends Controller
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
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Videomaterial $videomaterial)
    {
        return AdminImagesIdentifierResource::collection($videomaterial->images);
    }

    /**
     * @param VideomaterialImagesUpdateRelationshipsRequest $request
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(
        VideomaterialImagesUpdateRelationshipsRequest $request, Videomaterial $videomaterial)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($videomaterial, $Ids, 'videomaterial');
    }

}
