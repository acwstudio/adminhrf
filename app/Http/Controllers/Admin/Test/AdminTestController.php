<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCreateRequest;
use App\Http\Requests\Test\TestUpdateRequest;
use App\Http\Resources\Admin\Test\AdminTestCollection;
use App\Http\Resources\Admin\Test\AdminTestResource;
use App\Models\Image;
use App\Models\Test;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTestController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestController extends Controller
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
     * @return \App\Http\Resources\Admin\Test\AdminTestCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
//        $this->authorize('manage', Test::class);

        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Test::class)
            ->allowedIncludes([
                'images', 'questions', 'messages', 'comments', 'categories', 'likes', 'results'
            ])
            ->allowedSorts(['id', 'title', 'created_at', 'published_at'])
            ->jsonPaginate($perPage);

        return new AdminTestCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TestCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(TestCreateRequest $request)
    {
        $this->authorize('manage', Test::class);

        $dataAttributes = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');

        $test = Test::create($dataAttributes);

        if ($dataRelImages){
            /** @see ImageAssignmentService creates a relationship Image to Test */
            $this->imageAssignment->assign($test, $dataRelImages, 'test');
        }

//        $test->questions()->attach($dataRelQuestions);
        $test->categories()->attach($dataRelCategories);

        return (new AdminTestResource($test))
            ->response()
            ->header('Location', route('admin.tests.show', [
                'test' => $test->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return AdminTestResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Test $test)
    {
        $this->authorize('manage', Test::class);

        $query = QueryBuilder::for(Test::class)
            ->where('id', $test->id)
            ->allowedIncludes([
                'images', 'questions', 'messages', 'comments', 'categories', 'likes', 'results'
            ])
            ->firstOrFail();

        return new AdminTestResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TestUpdateRequest $request
     * @param Test $test
     * @return AdminTestResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TestUpdateRequest $request, Test $test)
    {
        $this->authorize('manage', Test::class);

        $data = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');

        $test->update($data);

//        if ($dataRelImages){
//            /** @see ImageAssignmentService creates a relationship Image to Test */
//            $this->imageAssignment->assign($test, $dataRelImages, 'test');
//        }

        $test->categories()->sync($dataRelCategories);

        return new AdminTestResource($test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Test $test
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Test $test)
    {
        $this->authorize('manage', Test::class);

        $idCategories = $test->categories()->allRelatedIds();
        $idQuestions = $test->questions()->allRelatedIds();

        $images = Image::where('imageable_id', $test->id)
            ->where('imageable_type', 'test')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $test->categories()->detach($idCategories);
        $test->questions()->detach($idQuestions);

        $test->messages()->delete();
        $test->likes()->delete();
        $test->comments()->delete();
        $test->results()->delete();

        $test->delete();

        return response(null, 204);

    }

}
