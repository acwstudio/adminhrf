<?php

namespace App\Http\Controllers\Admin\Videomaterial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Videomaterial\VideomaterialCreateRequest;
use App\Http\Requests\Videomaterial\VideomaterialUpdateRequest;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialCollection;
use App\Http\Resources\Admin\Videomaterial\AdminVideomaterialResource;
use App\Models\Image;
use App\Models\Videomaterial;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminVideomaterialController
 * @package App\Http\Controllers\Admin\Videomaterial
 */
class AdminVideomaterialController extends Controller
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
     * @return AdminVideomaterialCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $videomaterials = QueryBuilder::for(Videomaterial::class)
            ->allowedIncludes([
                'authors', 'comments', 'bookmarks', 'tags','images'
            ])
            ->allowedFilters(['yatextid'])
            ->allowedSorts(['id', 'title', 'published_at', 'created_at', 'event_date'])
            ->jsonPaginate($perPage);

        return new AdminVideomaterialCollection($videomaterials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideomaterialCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        /** @var Videomaterial $videomaterial */
        $videomaterial = Videomaterial::create($dataAttributes);

        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $videomaterial->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        $videomaterial->authors()->attach($dataRelAuthors);
        $videomaterial->tags()->attach($dataRelTags);

        return (new AdminVideomaterialResource($videomaterial))
            ->response()
            ->header('Location', route('admin.videomaterials.show', [
                'videomaterial' => $videomaterial->id
            ]));
//        return $dataAttributes;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminVideomaterialResource
     */
    public function show(Videomaterial $videomaterial)
    {
        $query = QueryBuilder::for(Videomaterial::class)
            ->where('id', $videomaterial->id)
            ->allowedIncludes([
                'authors', 'comments', 'bookmarks', 'tags','images'
            ])
            ->firstOrFail();

        return new AdminVideomaterialResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminVideomaterialResource
     */
    public function update(VideomaterialUpdateRequest $request, Videomaterial $videomaterial)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $videomaterial->update($dataAttributes);

        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $videomaterial->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        $videomaterial->authors()->sync($dataRelAuthors);
        $videomaterial->tags()->sync($dataRelTags);

        return new AdminVideomaterialResource($videomaterial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Videomaterial $videomaterial
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Videomaterial $videomaterial)
    {
        $idAuthors = $videomaterial->authors()->allRelatedIds();
        $idTags = $videomaterial->tags()->allRelatedIds();

        $videomaterial->authors()->detach($idAuthors);
        $videomaterial->tags()->detach($idTags);

        $images = Image::where('imageable_id', $videomaterial->id)
            ->where('imageable_type', 'videomaterial')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $videomaterial->images()->delete();

        $videomaterial->delete();

        return response(null, 204);
    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'videomaterial') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'videomaterial'
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
                if ($image->imageable_type !== 'videomaterial') {
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
