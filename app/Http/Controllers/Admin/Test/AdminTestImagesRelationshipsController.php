<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Image;
use App\Models\Test;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminTestImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestImagesRelationshipsController extends Controller
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
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminImagesIdentifierResource::collection($test->images);
    }

    /**
     * @param TestImagesUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestImagesUpdateRelationshipsRequest $request, Test $test)
    {
        $ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($test, $ids, 'test');
    }
}
