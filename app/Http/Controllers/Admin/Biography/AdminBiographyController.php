<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyCreateRequest;
use App\Http\Requests\Biography\BiographyUpdateRequest;
use App\Http\Resources\Admin\Biography\AdminBiographyCollection;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Models\Biography;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBiographyController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyController extends Controller
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
     * @param Request $request
     * @return AdminBiographyCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Biography::class);

        $perPage = $request->get('per_page');
        $biographies = QueryBuilder::for(Biography::class)
            ->allowedIncludes(['tags', 'bookmarks', 'categories', 'images', 'timeline'])
            ->allowedSorts(['firstname', 'surname'])
            ->jsonPaginate($perPage);

        return new AdminBiographyCollection($biographies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Biography\BiographyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BiographyCreateRequest $request)
    {
        $this->authorize('manage', Biography::class);

        $data = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var Biography $biography */
        $biography = Biography::create($data);

        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $biography->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        $biography->tags()->attach($dataRelTags);
        $biography->categories()->attach($dataRelCategories);

        return (new AdminBiographyResource($biography))
            ->response()
            ->header('Location', route('admin.biographies.show', [
                'biography' => $biography
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Biography $biography
     * @return AdminBiographyResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Biography $biography)
    {
        $this->authorize('manage', Biography::class);

        $query = QueryBuilder::for(Biography::class)
            ->where('id', $biography->id)
            ->allowedIncludes(['tags', 'bookmarks', 'categories', 'images', 'timeline'])
            ->firstOrFail();

        return new AdminBiographyResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BiographyUpdateRequest $request
     * @param Biography $biography
     * @return AdminBiographyResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BiographyUpdateRequest $request, Biography $biography)
    {
        $this->authorize('manage', Biography::class);

        $data = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $biography->update($data);

        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $biography->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        $biography->tags()->sync($dataRelTags);
        $biography->categories()->sync($dataRelCategories);

        return new AdminBiographyResource($biography);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Biography $biography
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Biography $biography)
    {
        $this->authorize('manage', Biography::class);

        $idCategories = $biography->categories()->allRelatedIds();
        $idTags = $biography->tags()->allRelatedIds();

        $biography->categories()->detach($idCategories);
        $biography->tags()->detach($idTags);

        $images = Image::where('imageable_id', $biography->id)
            ->where('imageable_type', 'biography')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $biography->images()->delete();
        $biography->timeline()->delete();
        $biography->bookmarks()->delete();

        $biography->delete();

        return response(null, 204);
    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'biography') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'biography'
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
                if ($image->imageable_type !== 'biography') {
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
