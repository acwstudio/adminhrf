<?php

namespace App\Http\Controllers\Admin\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleCreateRequest;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Resources\Admin\AdminArticleCollection;
use App\Http\Resources\Admin\AdminArticleResource;
use App\Models\Article;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminArticleController
 * @package App\Http\Controllers\Admin\Article
 */
class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminArticleCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {

        $this->authorize('manage', Article::class);

        $articles = QueryBuilder::for(Article::class)
//            ->allowedIncludes('comments', 'bookmarks')
            ->with('authors', 'tags', 'images')
            ->allowedFilters(['yatextid'])
            ->allowedSorts(['title', 'published_at'])
            ->jsonPaginate();

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
        $dataRelBookmarks = $request->input('data.relationships.bookmarks.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $article = Article::create($dataAttributes);

        $article->authors()->attach($dataRelAuthors);
        $article->tags()->attach($dataRelTags);
//        $article->bookmarks()->saveMany($dataRelBookmarks);
//        $article->images()->save($dataRelImages);

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
            ->allowedIncludes(['comments','bookmarks'])
            ->with('tags', 'authors', 'images')
            ->where('id', $article->id)
            ->firstOrFail();

        return new AdminArticleResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Article\ArticleUpdateRequest $request
     * @param Article $article
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelAuthors = $request->input('data.relationships.authors.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
//        $dataRelBookmarks = $request->input('data.relationships.bookmarks.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $article->update($dataAttributes);

        $article->authors()->sync($dataRelAuthors);
        $article->tags()->sync($dataRelTags);
//        I don't know what these relationships
//        $article->bookmarks()->saveMany($dataRelBookmarks);
//        $article->images()->save($dataRelImages);

//        $query = QueryBuilder::for(Article::class)
//            ->where('id', $article->id)
//            ->firstOrFail();

        return (new AdminArticleResource($article))
            ->response()
            ->header('Location', route('admin.articles.show', [
                'article' => $article->id
            ]));
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
        $article->images()->delete();
        $article->bookmarks()->delete();

//        delete images files....

        $article->delete();

        return response(null, 204);
    }
}
