<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentCreateRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Http\Resources\Admin\AdminDocumentCollection;
use App\Http\Resources\Admin\AdminDocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminDocumentController
 * @package App\Http\Controllers\Admin
 */
class AdminDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminDocumentCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Document::class)
            ->with('tags')
            ->allowedSorts('title')
            ->allowedIncludes('tags')
            ->jsonPaginate();

        return new AdminDocumentCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DocumentCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $document = Document::create($data);

        return (new AdminDocumentResource($document))
            ->response()
            ->header('Location', route('admin.documents.show', [
                'document' => $document
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminDocumentResource
     */
    public function show(Document $document)
    {
        $query = QueryBuilder::for(Document::where('id', $document->id))
            ->allowedIncludes('tags')
            ->firstOrFail();

        return new AdminDocumentResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentUpdateRequest $request
     * @param Document $document
     * @return AdminDocumentResource
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $data = $request->input('data.attributes');

        $document->update($data);

        return new AdminDocumentResource($document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Document $document
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return response(null, 204);
    }
}
