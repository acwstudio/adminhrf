<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentCreateRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Http\Resources\Admin\AdminDocumentCollection;
use App\Http\Resources\Admin\AdminDocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminDocumentCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        return new AdminDocumentCollection(Document::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DocumentCreateRequest $request)
    {
        $data = $request->validated();

        $document = Document::create($data['data']);

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
        return new AdminDocumentResource($document);
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
        $data = $request->validated();

        $document->update($data['data']);

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
