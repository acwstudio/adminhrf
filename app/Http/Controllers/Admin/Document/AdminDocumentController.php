<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentCreateRequest;
use App\Http\Requests\Document\DocumentUpdateRequest;
use App\Http\Resources\Admin\Document\AdminDocumentCollection;
use App\Http\Resources\Admin\Document\AdminDocumentResource;
use App\Models\Document;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminDocumentController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentController extends Controller
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
     * @return AdminDocumentCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Document::class);

        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Document::class)
            ->allowedIncludes(['category', 'bookmarks', 'images', 'tags'])
            ->allowedSorts(['title', 'document_date', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminDocumentCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DocumentCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(DocumentCreateRequest $request)
    {
        $this->authorize('manage', Document::class);

        $data = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');

        $document = Document::create($data);

        // Images
        $messages = [];

        if ($dataRelImages) {
            foreach ($dataRelImages as $id) {

                $image = Image::find($id);
                $result = $this->handleRelationships($image, $id);

                if ($result['result']) {
                    $document->images()->save($image);
                    array_push($messages, $result);
                } else {
                    response();
                    array_push($messages, $result);
                }

            }
        }

        // attach tags for the document
        $document->tags()->attach($dataRelTags);

        return (new AdminDocumentResource($document))
            ->response()
            ->header('Location', route('admin.documents.show', [
                'document' => $document
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Document $document
     * @return AdminDocumentResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Document $document)
    {
        $this->authorize('manage', Document::class);

        $query = QueryBuilder::for(Document::class)
            ->where('id', $document->id)
            ->allowedIncludes(['category', 'tags', 'bookmarks', 'images'])
            ->firstOrFail();

        return new AdminDocumentResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentUpdateRequest $request
     * @param Document $document
     * @return AdminDocumentResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $this->authorize('manage', Document::class);

        $data = $request->input('data.attributes');

        $document->update($data);

        return new AdminDocumentResource($document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Document $document)
    {
        $this->authorize('manage', Document::class);

        $idTags = $document->tags()->allRelatedIds();

        $document->tags()->detach($idTags);

        $document->images()->delete();
        $document->bookmarks()->delete();
        $document->delete();

        return response(null, 204);
    }

    /**
     * @param $image
     * @param $id
     * @return array
     */
    private function handleRelationships($image, $id)
    {
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'document') {
            $message = [
                'id_image' => $image->id,
                'result' => true,
                'description' => 'Image ' . $id . ' was related to ' . 'document'
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
                if ($image->imageable_type !== 'document') {
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
