<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCreateRequest;
use App\Http\Requests\Test\TestUpdateRequest;
use App\Http\Resources\Admin\AdminTestCollection;
use App\Http\Resources\Admin\AdminTestResource;
use App\Models\Image;
use App\Models\Test;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTestController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestController extends Controller
{
    private $imageService;

    /**
     * AdminArticleController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AdminTestCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(Test::class)
            ->allowedIncludes(['images', 'questions', 'messages', 'comments'])
            ->allowedSorts(['title', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminTestCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TestCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
//        return $dataRelImages;
        $test = Test::create($dataAttributes);

        // update field imageable_id of images table with new $article->id
        if ($dataRelImages) {
            foreach ($dataRelImages as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    Image::findOrFail($imageId)->update([
                        'imageable_id' => $test->id
                    ]);
                }
            }
        }

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
     */
    public function show(Test $test)
    {
        $query = QueryBuilder::for(Test::class)
            ->where('id', $test->id)
            ->allowedIncludes(['images', 'messages', 'questions', 'results', 'comments'])
            ->firstOrFail();

        return new AdminTestResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return AdminTestResource
     */
    public function update(TestUpdateRequest $request, Test $test)
    {
        $data = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $test->update($data);

        if ($dataRelImages) {
            foreach ($dataRelImages as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    Image::findOrFail($imageId)->update([
                        'imageable_id' => $test->id
                    ]);
                }
            }
        }

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
        $images = Image::where('imageable_id', $test->id)
            ->where('imageable_type', 'article');

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $test->delete();

        return response(null, 204);

    }
}
