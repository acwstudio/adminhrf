<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsCreateRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\News\AdminNewsCollection;
use App\Http\Resources\Admin\News\AdminNewsResource;
use App\Models\Image;
use App\Models\News;
use App\Models\Tag;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminNewsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsController extends Controller
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
     * @param Request $request
     * @return AdminNewsCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', News::class);

        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(News::class)
            ->allowedIncludes(['tags', 'images', 'bookmarks', 'comments'])
            ->allowedSorts(['id', 'title', 'published_at'])
//            ->allowedFilters(['status', 'show_in_main', 'show_in_afisha'])
            ->jsonPaginate($perPage);

        return new AdminNewsCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(NewsCreateRequest $request)
    {
        $this->authorize('manage', News::class);

        $data = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');

        $news = News::create($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to News */
            $this->imageAssignment->assign($news, $dataRelImages, 'news');
        }

        if ($dataRelTags){
            $news->tags()->attach($dataRelTags);
        }

        return (new AdminNewsResource($news))
            ->response()
            ->header('Location', route('admin.news.show', [
                'news' => $news
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return AdminNewsResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(News $news)
    {
        $this->authorize('manage', News::class);

        $query = QueryBuilder::for(News::class)
            ->where('id', $news->id)
            ->allowedIncludes('tags', 'images', 'bookmarks', 'comments')
            ->firstOrFail();

        return new AdminNewsResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsUpdateRequest $request
     * @param News $news
     * @return AdminNewsResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $this->authorize('manage', News::class);

        $data = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');

        $news->update($data);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to News */
            $this->imageAssignment->assign($news, $dataRelImages, 'news');
        }

        if ($dataRelTags){
            $news->tags()->sync($dataRelTags);
        }

        return new AdminNewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $this->authorize('manage', News::class);

        $idTags = $news->tags()->allRelatedIds();

        $news->tags()->detach($idTags);

        $images = Image::where('imageable_id', $news->id)
            ->where('imageable_type', 'news')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $news->comments()->delete();
        $news->bookmarks()->delete();
        $news->delete();

        return response(null, 204);
    }

}
