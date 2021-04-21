<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyCreateRequest;
use App\Http\Requests\Biography\BiographyUpdateRequest;
use App\Http\Resources\Admin\Biography\AdminBiographyCollection;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Models\Biography;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBiographyController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyController extends Controller
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
            ->allowedSorts(['firstname', 'surname', 'published_at'])
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

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Biography */
            $this->imageAssignment->assign($biography, $dataRelImages, 'biography');
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

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Biography */
            $this->imageAssignment->assign($biography, $dataRelImages, 'biography');
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

}
