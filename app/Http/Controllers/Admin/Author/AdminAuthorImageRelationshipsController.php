<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorImageUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Author;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminAuthorImageRelationshipsController
 * @package App\Http\Controllers\Admin\Author
 */
class AdminAuthorImageRelationshipsController extends Controller
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
     * @param Author $author
     * @return AdminImagesIdentifierResource
     */
    public function index(Author $author)
    {
        return new AdminImagesIdentifierResource($author->image);
    }

    /**
     * @param AuthorImageUpdateRelationshipsRequest $request
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AuthorImageUpdateRelationshipsRequest $request, Author $author)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($author, $Ids, 'author');
    }

}
