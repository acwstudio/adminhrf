<?php

namespace App\Http\Controllers\Admin\DocumentCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentCategory\DocumentCategoryCreateRequest;
use App\Http\Requests\DocumentCategory\DocumentCategoryUpdateRequest;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryCollection;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryLightResource;
use App\Http\Resources\Admin\DocumentCategory\AdminDocumentCategoryResource;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminDocumentCategoryController
 * @package App\Http\Controllers\Admin\DocumentCategory
 */
class AdminDocumentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminDocumentCategoryCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(DocumentCategory::class)
            ->allowedIncludes('documents')
            ->allowedSorts(['id', 'title'])
            ->jsonPaginate($perPage);

        return new AdminDocumentCategoryCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DocumentCategoryCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $documentCategory = DocumentCategory::create($data);

        return (new AdminDocumentCategoryResource($documentCategory))
            ->response()
            ->header('Location', route('admin.document-categories.show', [
                'document_category' => $documentCategory->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param DocumentCategory $category
     * @return AdminDocumentCategoryResource
     */
    public function show(DocumentCategory $documentCategory)
    {
        $query = QueryBuilder::for(DocumentCategory::class)
            ->where('id', $documentCategory->id)
            ->allowedIncludes(['documents'])
            ->firstOrFail();

        return new AdminDocumentCategoryResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentCategoryUpdateRequest $request
     * @param DocumentCategory $documentCategory
     * @return AdminDocumentCategoryResource
     */
    public function update(DocumentCategoryUpdateRequest $request, DocumentCategory $documentCategory)
    {
        $data = $request->input('data.attributes');

        $documentCategory->update($data);

        return new AdminDocumentCategoryResource($documentCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DocumentCategory $documentCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DocumentCategory $documentCategory)
    {
        if ($documentCategory->documents()) {
            return response('Категория имеет связанные документы', 405);
        }

        $documentCategory->delete();

        return response(null, 204);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $categories = QueryBuilder::for(DocumentCategory::class)
            ->allowedSorts(['id', 'title'])
            ->get();

        return AdminDocumentCategoryLightResource::collection($categories);
    }
}
