<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Http\Resources\Admin\AdminArticleResource;
use App\Models\Article;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminArticleController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleController extends Controller
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
     * @return AdminArticleCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('manage', Article::class);

        $perPage = $request->get('per_page');

        $articles = QueryBuilder::for(Article::class)
            ->allowedIncludes(['comments', 'bookmarks', 'tags', 'category'])
            ->allowedFilters(['yatextid'])
            ->allowedSorts(['id', 'title', 'published_at', 'created_at', 'event_date'])
            ->jsonPaginate($perPage);

        return new AdminArticleCollection($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
//        $dataRelBookmarks = $request->input('data.relationships.bookmarks.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
//        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');

        $article = Article::create($dataAttributes);

        // update field imageable_id of images table with new $article->id
        if ($dataRelImages) {
            foreach ($dataRelImages as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    Image::findOrFail($imageId)->update([
                        'imageable_id' => $article->id
                    ]);
                }
            }
        }

        // attach authors and tags for the article
        $article->authors()->attach($dataRelAuthors);
        $article->tags()->attach($dataRelTags);

//        $article->bookmarks()->saveMany($dataRelBookmarks);

//        return $article->id;
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
     * @return AdminArticleResource
     */
    public function show(Article $article)
    {
        $query = QueryBuilder::for(Article::class)
            ->where('id', $article->id)
            ->allowedIncludes(['authors', 'tags', 'images', 'timeline'])
            ->firstOrFail();

        return new AdminArticleResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Article\ArticleUpdateRequest $request
     * @param Article $article
     * @return AdminArticleResource
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
//        $dataRelBookmarks = $request->input('data.relationships.bookmarks.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelCategories = $request->input('data.relationships.categories.data.*.id');

        $article->update($dataAttributes);

        if ($dataRelImages) {
            foreach ($dataRelImages as $imageId) {
                $image = Image::find($imageId);
                if ($image) {
                    Image::findOrFail($imageId)->update([
                        'imageable_id' => $article->id
                    ]);
                }
            }
        }

        if ($dataRelCategories) {
            $article->category()->associate($dataRelCategories[0])->save();
        }

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
        $idAuthors = $article->authors()->allRelatedIds();
        $idTags = $article->tags()->allRelatedIds();

        $article->authors()->detach($idAuthors);
        $article->tags()->detach($idTags);
//        $article->bookmarks()->delete();
        $images = Image::where('imageable_id', $article->id)
            ->where('imageable_type', 'article')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }
        $article->images()->delete();
        $article->comments()->delete();
        $article->timeline()->delete();

        $article->delete();

        return response(null, 204);
    }
}
