<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\TAnswer;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminAnswerImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswerImagesRelationshipsController extends Controller
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
     * @param TAnswer $answer
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(TAnswer $answer)
    {
        return AdminImagesIdentifierResource::collection($answer->images);
    }

    /**
     * @param AnswerImagesUpdateRelationshipsRequest $request
     * @param TAnswer $answer
     * @return mixed
     */
    public function update(AnswerImagesUpdateRelationshipsRequest $request, TAnswer $answer)
    {
        $ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($answer, $ids, 'answer');
    }
}
