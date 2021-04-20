<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\Admin\Article\AdminArticleCollection;
use App\Http\Resources\Admin\Article\AdminArticleLightResource;
use App\Http\Resources\Admin\Article\AdminArticleResource;
use App\Models\Article;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminArticleController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleController extends Controller
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
     * @return \App\Http\Resources\Admin\Article\AdminArticleCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Article::class);

        $perPage = $request->get('per_page');

        $articles = QueryBuilder::for(Article::class)
            ->allowedIncludes([
                'authors', 'comments', 'bookmarks', 'tags', 'category','images', 'timeline'
            ])
            ->allowedFilters([
                'yatextid',
                AllowedFilter::callback(
                    'no_timeline', fn (Builder $query) => $query->whereDoesntHave('timeline')
                ),
            ])
            ->allowedSorts(['id', 'title', 'published_at', 'created_at', 'event_date'])
            ->jsonPaginate($perPage);

        return new AdminArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ArticleCreateRequest $request)
    {
        $this->authorize('manage', Article::class);

        $dataAttributes = $request->input('data.attributes');

        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $article = Article::create($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Article */
            $this->imageAssignment->assign($article, $dataRelImages, 'article');
        }

        $article->authors()->attach($dataRelAuthors);
        $article->tags()->attach($dataRelTags);

        return (new AdminArticleResource($article))
            ->response()
            ->header('Location', route('admin.articles.show', [
                'article' => $article->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return \App\Http\Resources\Admin\Article\AdminArticleResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Article $article)
    {
        $this->authorize('manage', Article::class);

        $query = QueryBuilder::for(Article::class)
            ->where('id', $article->id)
            ->allowedIncludes([
                'authors', 'comments', 'bookmarks', 'tags', 'category','images', 'timeline'
            ])
            ->firstOrFail();

        return new AdminArticleResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Article\ArticleUpdateRequest $request
     * @param Article $article
     * @return \App\Http\Resources\Admin\Article\AdminArticleResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $this->authorize('manage', Article::class);

        $dataAttributes = $request->input('data.attributes');
        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $article->update($dataAttributes);

//        if ($dataRelImages) {
//            /** @see ImageAssignmentService creates a relationship Image to Article */
//            $this->imageAssignment->assign($article, $dataRelImages, 'article');
//        }

//        if ($dataRelCategories) {
//            $article->category()->associate($dataRelCategories[0])->save();
//        }

        $article->authors()->sync($dataRelAuthors);
        $article->tags()->sync($dataRelTags);

        return new AdminArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        $this->authorize('manage', Article::class);

        $idAuthors = $article->authors()->allRelatedIds();
        $idTags = $article->tags()->allRelatedIds();

        $article->authors()->detach($idAuthors);
        $article->tags()->detach($idTags);

        $images = Image::where('imageable_id', $article->id)
            ->where('imageable_type', 'article')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $article->images()->delete();
        $article->comments()->delete();
        $article->timeline()->delete();
        $article->bookmarks()->delete();

        $article->delete();

        return response(null, 204);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function light(Request $request)
    {
        $this->authorize('manage', Article::class);

        $perPage = $request->get('per_page');

        $articles = QueryBuilder::for(Article::class)
            ->allowedFilters([
                AllowedFilter::callback(
                    'has_timeline', fn (Builder $query) => $query->whereDoesntHave('timeline')
                ),
            ])
            ->allowedSorts(['id', 'title'])
            ->jsonPaginate($perPage);

        return AdminArticleLightResource::collection($articles);
    }

}
