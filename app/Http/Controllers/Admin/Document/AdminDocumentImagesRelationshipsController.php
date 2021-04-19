<?php

namespace App\Http\Controllers\Admin\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Document;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminDocumentImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Document
 */
class AdminDocumentImagesRelationshipsController extends Controller
{
    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminTestImagesRelationshipsController constructor.
     * @param ImageAssignmentService $imageAssignment
     */
    public function __construct(ImageAssignmentService $imageAssignment)
    {
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * @param Document $document
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Document $document)
    {
        return AdminImagesIdentifierResource::collection($document->images);
    }

    /**
     * @param DocumentImagesUpdateRelationshipsRequest $request
     * @param Document $document
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DocumentImagesUpdateRelationshipsRequest $request, Document $document)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($document, $Ids, 'document');
    }

}
