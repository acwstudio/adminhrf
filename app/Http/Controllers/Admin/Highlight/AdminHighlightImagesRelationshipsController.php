<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HihglightImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Highlight;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightImagesRelationshipsController extends Controller
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
     * @param Highlight $highlight
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Highlight $highlight)
    {
        return AdminImagesIdentifierResource::collection($highlight->images);
    }

    /**
     * @param HihglightImagesUpdateRelationshipsRequest $request
     * @param Highlight $highlight
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HihglightImagesUpdateRelationshipsRequest $request, Highlight $highlight)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($highlight, $Ids, 'highlight');
    }
}
