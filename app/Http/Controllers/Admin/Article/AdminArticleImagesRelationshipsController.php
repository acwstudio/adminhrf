<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Article\AdminArticleIdentifireResource;
use App\Models\Article;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminArticleImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleImagesRelationshipsController extends Controller
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
     * @param Article $article
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Article $article)
    {
        return AdminArticleIdentifireResource::collection($article->images);
    }

    /**
     * @param ArticleImagesUpdateRelationshipsRequest $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleImagesUpdateRelationshipsRequest $request, Article $article)
    {
        $ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($article, $ids, 'article');
    }

}
