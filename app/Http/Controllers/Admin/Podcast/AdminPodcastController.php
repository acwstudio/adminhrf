<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastCreateRequest;
use App\Http\Requests\Podcast\PodcastUpdateRequest;
use App\Http\Resources\Admin\Podcast\AdminPodcastCollection;
use App\Http\Resources\Admin\Podcast\AdminPodcastResource;
use App\Models\Image;
use App\Models\Podcast;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminPodcastController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastController extends Controller
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
     * @return AdminPodcastCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Podcast::class)
            ->allowedIncludes(['tags', 'images', 'bookmarks'])
            ->allowedSorts(['id', 'title', 'order', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminPodcastCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PodcastCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PodcastCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var Podcast $podcast */
        $podcast = Podcast::create($dataAttributes);

        /** @see ImageAssignmentService creates a relationship Image to Podcast */
        $this->imageAssignment->assign($podcast, $dataRelImages, 'podcast');

        $podcast->tags()->attach($dataRelTags);

        return (new AdminPodcastResource($podcast))
            ->response()
            ->header('Location', route('admin.podcasts.show', [
                'podcast' => $podcast->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Podcast $podcast
     * @return AdminPodcastResource
     */
    public function show(Podcast $podcast)
    {
        $query = QueryBuilder::for(Podcast::class)
            ->where('id', $podcast->id)
            ->allowedIncludes(['tags', 'images', 'bookmarks'])
            ->firstOrFail();

        return new AdminPodcastResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PodcastUpdateRequest $request
     * @param Podcast $podcast
     * @return \App\Http\Resources\Admin\Podcast\AdminPodcastResource
     */
    public function update(PodcastUpdateRequest $request, Podcast $podcast)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var Podcast $podcast */
        $podcast->update($dataAttributes);

        /** @see ImageAssignmentService creates a relationship Image to Podcast */
        $this->imageAssignment->assign($podcast, $dataRelImages, 'podcast');

        $podcast->tags()->sync($dataRelTags);

        return new AdminPodcastResource($podcast);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Podcast $podcast
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Podcast $podcast)
    {
        $idTags = $podcast->tags()->allRelatedIds();

        $podcast->tags()->detach($idTags);

        $images = Image::where('imageable_id', $podcast->id)
            ->where('imageable_type', 'podcast')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $podcast->images()->delete();

        $podcast->delete();

        return response(null, 204);
    }

}
