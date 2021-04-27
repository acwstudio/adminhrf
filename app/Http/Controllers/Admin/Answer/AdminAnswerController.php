<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerCreateRequest;
use App\Http\Requests\Answer\AnswerUpdateRequest;
use App\Http\Resources\Admin\Answer\AdminAnswerCollection;
use App\Http\Resources\Admin\Answer\AdminAnswerResource;
use App\Http\Resources\Admin\Question\AdminQuestionResource;
use App\Models\Image;
use App\Models\Question;
use App\Models\TAnswer;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAnswerController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswerController extends Controller
{
    /** @var ImageService  */
    private $imageService;

    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminArticleController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService, ImageAssignmentService $imageAssignment)
    {
        $this->imageService = $imageService;
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Admin\Answer\AdminAnswerCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(TAnswer::class)
            ->allowedIncludes(['question', 'images'])
            ->allowedSorts(['id', 'title', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminAnswerCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AnswerCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AnswerCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var TAnswer $answer */
        $answer = TAnswer::create($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Answer */
            $this->imageAssignment->assign($answer, $dataRelImages, 'answer');
        }

        return (new AdminAnswerResource($answer))
            ->response()
            ->header('Location', route('admin.answers.show', [
                'answer' => $answer->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param TAnswer $answer
     * @return AdminAnswerResource
     */
    public function show(TAnswer $answer)
    {
        $query = QueryBuilder::for(TAnswer::class)
            ->where('id', $answer->id)
            ->allowedIncludes(['question'])
            ->firstOrFail();

        return new AdminAnswerResource($query);
    }

    /**
     * Update the specified resource in storage.
     *,
     * @param AnswerUpdateRequest $request
     * @param TAnswer $answer
     * @return AdminAnswerResource
     */
    public function update(AnswerUpdateRequest $request, TAnswer $answer)
    {
        $data = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $answer->update($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Answer */
            $this->imageAssignment->assign($answer, $dataRelImages, 'answer');
        }

        return new AdminAnswerResource($answer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TAnswer $answer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TAnswer $answer)
    {
        $images = Image::where('imageable_id', $answer->id)
            ->where('imageable_type', 'answer')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }


        $answer->delete();

        return response(null, 204);
    }
}
