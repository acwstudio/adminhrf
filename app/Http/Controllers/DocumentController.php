<?php

namespace App\Http\Controllers;

use App\Http\Resources\DocumentCategoryResource;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentShortResource;
use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $categories = DocumentCategory::withCount('documents')->orderBy('documents_count', 'desc')->get();

        return DocumentCategoryResource::collection($categories);

    }

    /**
     * Display paged documents by category.
     *
     * @param \Illuminate\Http\Request $request
     * @param DocumentCategory $category
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function documents(Request $request, DocumentCategory $category)
    {
        $perPage = $request->get('per_page', 45);

        return DocumentShortResource::collection($category->documents()->latest()->paginate($perPage))
            ->additional(['category' => DocumentCategoryResource::make($category)]);
    }

    /**
     * Display the specified document.
     *
     * @param \Illuminate\Http\Request $request
     * @param DocumentCategory $category
     * @param Document $document
     * @return DocumentResource
     */
    public function show(Request $request, DocumentCategory $category, Document $document)
    {
        return new DocumentResource($document);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Document $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
