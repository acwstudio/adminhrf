<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessage\MessageCreateRequest;
use App\Http\Requests\TestMessage\MessageUpdateRequest;
use App\Http\Resources\Admin\TestMessage\AdminMessageCollection;
use App\Http\Resources\Admin\TestMessage\AdminMessageResource;
use App\Models\Image;
use App\Models\Test;
use App\Models\TestMessage;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminMessageController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessageController extends Controller
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
     * @return AdminMessageCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(TestMessage::class)
            ->allowedIncludes(['test', 'images'])
            ->allowedSorts(['id', 'title'])
            ->jsonPaginate($perPage);

        return new AdminMessageCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageCreateRequest $request)
    {
        $data = $request->input('data.attributes');

//        $dataRelTest = $request->input('data.relationships.tests.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var TestMessage $message */
        $message = TestMessage::create($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Message */
            $this->imageAssignment->assign($message, $dataRelImages, 'message');
        }

        return (new AdminMessageResource($message))
            ->response()
            ->header('Location', route('admin.messages.show', [
                'message' => $message->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\TestMessage\AdminMessageResource
     */
    public function show(TestMessage $message)
    {
        $query = QueryBuilder::for(TestMessage::class)
            ->allowedIncludes(['test'])
            ->firstOrFail();

        return new AdminMessageResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminMessageResource
     */
    public function update(MessageUpdateRequest $request, TestMessage $message)
    {
        $data = $request->input('data.attributes');

//        $dataRelTest = $request->input('data.relationships.tests.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $message->update($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Message */
            $this->imageAssignment->assign($message, $dataRelImages, 'message');
        }

        return new AdminMessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TestMessage $message)
    {
        $images = Image::where('imageable_id', $message->id)
            ->where('imageable_type', 'message')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }


        $message->delete();

        return response(null, 204);
    }
}
