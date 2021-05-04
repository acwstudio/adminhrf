<?php

namespace App\Http\Controllers\Admin\Audiomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Audiomaterial\AudiomaterialCreateRequest;
use App\Http\Requests\Audiomaterial\AudiomaterialUpdateRequest;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialCollection;
use App\Http\Resources\Admin\Audiomaterial\AdminAudiomaterialResource;
use App\Models\Audiofile;
use App\Models\Audiomaterial;
use App\Models\Bookmark;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Audiomaterial::class);

        $perPage = $request->get('per_page');

        $audiomaterials = QueryBuilder::for(Audiomaterial::class)
            ->allowedIncludes(['tags', 'highlights', 'images', 'bookmarks', 'audiofile'])
            ->allowedSorts(['id', 'title', 'created_at'])
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
        $this->authorize('manage', Audiomaterial::class);

        $error = false;
        $messages = [];

        $dataAttributes = $request->input('data.attributes');

        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelHighlights = $request->input('data.relationships.highlights.data.*.id');


        $dataRelAudio = $request->input('data.relationships.audiofiles.data.*.id');
        /** @var Audiomaterial $audiomaterial */
        $audiomaterial = Audiomaterial::create($dataAttributes);

        if (!empty($dataRelAudio)){

            /** @var Audiofile $audiofile */
            $audiofile = Audiofile::find($dataRelAudio[0]);
            if (!$audiofile->audiomaterial_id){
                $audiofile->update([
                    'audiomaterial_id' => $audiomaterial->id
                ]);
            } else {
                $error = true;
                $messages[] = 'Bad audiofile relation!';
            }

        } else {
            $error = true;
            $messages[] = 'Resource must have audiofile relation!';
        }

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        if (!empty($dataRelImages)) {
            $image = Image::find($dataRelImages[0]);
            if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'audiomaterial') {
                $audiomaterial->images()->save($image);
            } else {
                $error = true;
                $messages[] = 'Bad image relation!';
            }
        } else {
            $error = true;
            $messages[] = 'Resource must have image relation!';
        }

        if ($dataRelTags){
            $audiomaterial->tags()->attach($dataRelTags);
        }

        if ($dataRelHighlights){
            $audiomaterial->highlights()->attach($dataRelHighlights);
        }


        if ($error) {
            $audiomaterial->images()->delete();
            $audiomaterial->highlights()->detach();
            $audiomaterial->delete();
            abort(403, join('|', $messages));
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
     * @param Audiomaterial $audiomaterial
     * @return AdminAudiomaterialResource
     * @throws AuthorizationException
     */
    public function show(Audiomaterial $audiomaterial)
    {
        $this->authorize('manage', Audiomaterial::class);

        $query = QueryBuilder::for(Audiomaterial::class)
            ->where('id', $audiomaterial->id)
            ->allowedIncludes(['tags', 'highlights', 'images', 'bookmarks', 'audiofile'])
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
        $this->authorize('manage', Audiomaterial::class);

        $dataAttributes = $request->input('data.attributes');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelHighlights = $request->input('data.relationships.highlights.data.*.id');

        $audiomaterial->update($dataAttributes);

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
     * @param Audiomaterial $audiomaterial
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Audiomaterial $audiomaterial)
    {
        $this->authorize('manage', Audiomaterial::class);

        $audiomaterial->tags()->detach();
        $audiomaterial->audiofile()->delete();
        $audiomaterial->images()->delete();
        $audiomaterial->tags()->detach();
        $audiomaterial->highlights()->detach();
        $audiomaterial->bookmarks()->delete();

        $audiomaterial->delete();

        return response(null, 204);
    }

}
