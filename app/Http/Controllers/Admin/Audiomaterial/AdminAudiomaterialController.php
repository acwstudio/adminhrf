<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialCreateRequest;
use App\Http\Requests\Audiomaterial\AudiomaterialUpdateRequest;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialCollection;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Models\Audiomaterial;
use App\Models\Bookmark;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAudiomaterialController
 * @package App\Http\Controllers\Admin\Audiomaterials
 */
class AdminAudiomaterialController extends Controller
{
    /** @var ImageService */
    private $imageService;

    /** @var ImageAssignmentService */
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
     * @return AdminAudiomaterialCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $audiomaterials = QueryBuilder::for(Audiomaterial::class)
            ->allowedIncludes(['tags', 'highlights', 'images', 'bookmarks'])
            ->allowedSorts(['id', 'title'])
            ->jsonPaginate($perPage);

        return new AdminAudiomaterialCollection($audiomaterials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AudiomaterialCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelHighlights = $request->input('data.relationships.highlights.data.*.id');
        $dataRelBookmarks = $request->input('data.relationships.bookmarks.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var Audiomaterial $audiomaterial */
        $audiomaterial = Audiomaterial::create($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Audiomaterial */
            $this->imageAssignment->assign($audiomaterial, $dataRelImages, 'audiomaterial');
        }

        if ($dataRelTags){
            $audiomaterial->tags()->attach($dataRelTags);
        }

        if ($dataRelHighlights){
            $audiomaterial->highlights()->attach($dataRelHighlights);
        }

        if ($dataRelBookmarks){
//            ToDo create bookmarks
        }

        return (new AdminAudiomaterialResource($audiomaterial))
            ->response()
            ->header('Location', route('admin.audiomaterials.show', [
                'audiomaterial' => $audiomaterial->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AdminAudiomaterialResource
     */
    public function show(Audiomaterial $audiomaterial)
    {
        $query = QueryBuilder::for(Audiomaterial::class)
            ->where('id', $audiomaterial->id)
            ->allowedIncludes(['tags', 'highlights', 'images', 'bookmarks'])
            ->firstOrFail();

        return new AdminAudiomaterialResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AudiomaterialUpdateRequest $request
     * @param Audiomaterial $audiomaterial
     * @return AdminAudiomaterialResource
     */
    public function update(AudiomaterialUpdateRequest $request, Audiomaterial $audiomaterial)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelHighlights = $request->input('data.relationships.highlights.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $audiomaterial->update($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Audiomaterial */
            $this->imageAssignment->assign($audiomaterial, $dataRelImages, 'audiomaterial');
        }

        if ($dataRelTags){
            $audiomaterial->tags()->sync($dataRelTags);
        }

        if ($dataRelHighlights){
            $audiomaterial->highlights()->sync($dataRelHighlights);
        }

        return new AdminAudiomaterialResource($audiomaterial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Audiomaterial $audiomaterial)
    {
        $idTags = $audiomaterial->tags()->allRelatedIds();

        $audiomaterial->tags()->detach($idTags);

        $images = Image::where('imageable_id', $audiomaterial->id)
            ->where('imageable_type', 'audiomaterial')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $audiomaterial->tags()->detach();
        $audiomaterial->highlights()->detach();
        $audiomaterial->bookmarks()->delete();
        $audiomaterial->delete();

        return response(null, 204);
    }

}
