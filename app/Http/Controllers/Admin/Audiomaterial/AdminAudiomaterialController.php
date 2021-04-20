<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialCreateRequest;
use App\Http\Requests\Audiomaterial\AudiomaterialUpdateRequest;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialCollection;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Models\Audiomaterial;
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
     * @return AdminAudiomaterialCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $audiomaterials = QueryBuilder::for(Audiomaterial::class)
            ->allowedIncludes(['tags', 'authors', 'images'])
            ->allowedSorts(['firstname', 'surname'])
            ->jsonPaginate($perPage);

        return new AdminAudiomaterialCollection($audiomaterials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AudiomaterialCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        if ($dataRelImages) {
            /** @var Audiomaterial $audiomaterial */
            $audiomaterial = Audiomaterial::create($dataAttributes);
        }

        /** @see ImageAssignmentService creates a relationship Image to Audiomaterial */
        $this->imageAssignment->assign($audiomaterial, $dataRelImages, 'audiomaterial');

        $audiomaterial->tags()->attach($dataRelTags);

        return (new AdminAudiomaterialResource($audiomaterial))
            ->response()
            ->header('Location', route('admin.audiomaterials.show', [
                'audiomaterial' => $audiomaterial->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminAudiomaterialResource
     */
    public function show(Audiomaterial $audiomaterial)
    {
        $query = QueryBuilder::for(Audiomaterial::class)
            ->where('id', $audiomaterial->id)
            ->allowedIncludes(['tags', 'authors', 'images'])
            ->firstOrFail();

        return new AdminAudiomaterialResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminAudiomaterialResource
     */
    public function update(AudiomaterialUpdateRequest $request, Audiomaterial $audiomaterial)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $audiomaterial->update($dataAttributes);

//        if ($dataRelImages) {
//            /** @var Audiomaterial $audiomaterial */
//            $audiomaterial = Audiomaterial::create($dataAttributes);
//        }

        $audiomaterial->tags()->sync($dataRelTags);

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
            ->where('imageable_type', 'videomaterial')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $audiomaterial->images()->delete();

        $audiomaterial->delete();

        return response(null, 204);
    }

}
