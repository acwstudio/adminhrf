<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessage\MessageImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\TestMessage;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminMessageImagesRelationshipsController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessageImagesRelationshipsController extends Controller
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
     * @param TestMessage $testMessage
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TestMessage $message)
    {
        return AdminImagesIdentifierResource::collection($message->images);
    }

    /**
     * @param MessageImagesUpdateRelationshipsRequest $request
     * @param TestMessage $testMessage
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function update(MessageImagesUpdateRelationshipsRequest $request, TestMessage $message)
    {
        $ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($message, $ids, 'message');
    }
}
