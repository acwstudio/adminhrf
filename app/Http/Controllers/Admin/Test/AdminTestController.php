<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCreateRequest;
use App\Http\Requests\Test\TestUpdateRequest;
use App\Http\Resources\Admin\Test\AdminTestCollection;
use App\Http\Resources\Admin\Test\AdminTestResource;
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
     * @return \App\Http\Resources\Admin\Test\AdminTestCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
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
     */
    public function store(TestCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
//        $dataRelQuestions = $request->input('data.relationships.questions.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');
//        return $dataRelCategories;
        $test = Test::create($dataAttributes);

        // update field imageable_id of images table with new $article->id

        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $test->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        // attach authors and categories for the test
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
     */
    public function show(Test $test)
    {
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
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $test->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
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
            ->where('imageable_type', 'test')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $test->delete();

        return response(null, 204);

    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'test') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'test'
            ];

            return $message;

        } else {
            if (!$image) {
                $message = [
                    'id_image' => $image->id,
                    'result' => false,
                    'description' => 'Image ' . $id . ' is not exists'
                ];
            } else {
                if (!is_null($image->imageable_id)) {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' already has ' . $image->imageable_type
                            . ' relation'
                    ];
                }
                if ($image->imageable_type !== 'test') {
                    $message = [
                        'id_image' => $image->id,
                        'result' => false,
                        'description' => 'Image ' . $id . ' will be related to ' . $image->imageable_type
                    ];
                }
            }
            return $message;
        }

    }
}
