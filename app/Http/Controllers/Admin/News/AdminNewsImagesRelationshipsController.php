<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Image;
use App\Models\News;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminNewsImagesRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsImagesRelationshipsController extends Controller
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
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminImagesIdentifierResource::collection($news->images);
    }

    /**
     * @param NewsImagesUpdateRelationshipsRequest $request
     * @param News $news
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(NewsImagesUpdateRelationshipsRequest $request, News $news)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($news, $Ids, 'news');
    }

}
