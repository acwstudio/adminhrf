<?php

namespace App\Http\Controllers\Admin\ArticleCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategory\ArticleCategoryCreateRequest;
use App\Http\Requests\ArticleCategory\ArticleCategoryUpdateRequest;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryCollection;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryLightResource;
use App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryResource;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminArticleCategoryController
 * @package App\Http\Controllers\Admin\ArticleCategory
 */
class AdminArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminArticleCategoryCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(ArticleCategory::class)
            ->allowedIncludes('articles')
            ->allowedSorts(['id', 'title'])
            ->jsonPaginate($perPage);

        return new AdminArticleCategoryCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleCategoryCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $articleCategory = ArticleCategory::create($data);

        return (new AdminArticleCategoryResource($articleCategory))
            ->response()
            ->header('Location', route('admin.article-categories.show', [
                'article_category' => $articleCategory->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryResource
     */
    public function show(ArticleCategory $articleCategory)
    {
        $query = QueryBuilder::for(ArticleCategory::class)
            ->where('id', $articleCategory->id)
            ->allowedIncludes(['articles'])
            ->firstOrFail();

        return new AdminArticleCategoryResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\Admin\ArticleCategory\AdminArticleCategoryResource
     */
    public function update(ArticleCategoryUpdateRequest $request, ArticleCategory $articleCategory)
    {
        $data = $request->input('data.attributes');

        $articleCategory->update($data);

        return new AdminArticleCategoryResource($articleCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArticleCategory $articleCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        if ($articleCategory->articles()) {
            return response('?????????????????? ?????????? ?????????????????? ????????????', 405);
        }

        $articleCategory->delete();

        return response(null, 204);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $categories = QueryBuilder::for(ArticleCategory::class)
            ->allowedSorts(['id', 'title'])
            ->get();

        return AdminArticleCategoryLightResource::collection($categories);
    }
}
