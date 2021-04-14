<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Http\Resources\Admin\Document\AdminDocumentResource;
use App\Models\Document;
use App\Services\ImageService;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPdfController extends Controller
{


    /**
     * Save uploaded pdf and generate set of images from it
     * Returns saved pdf path and id's of related images
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('manage', Document::class);

        $validated = $request->validate([
            'file' => 'required|mimetypes:application/pdf,application/x-pdf'
        ]);

        $newPath = ImageService::DOCS_PATH . ImageService::dirById(Document::max('id') + 1);

        $path = $request->file('file')->store($newPath);

        $pdf = PdfService::make(Storage::path($path));
        $images = $pdf->saveAllPagesAsImages();


        return response()->json([
            'data' => [
                'file' => $path,
                'images' => AdminImagesIdentifierResource::collection($images)
            ]
        ]);

    }


    /**
     * Update documents pdf file and set of related images
     *
     * @param Request $request
     * @param Document $document
     * @return AdminDocumentResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Document $document)
    {
        $this->authorize('manage', Document::class);

        $validated = $request->validate([
            'file' => 'required|mimetypes:application/pdf,application/x-pdf'
        ]);

        $newPath = ImageService::DOCS_PATH . ImageService::dirById($document->id);

        $path = $request->file('file')->store($newPath);

        $pdf = PdfService::make(Storage::path($path));
        $images = $pdf->saveAllPagesAsImages();

        $document->file = $path;
        $document->images()->delete();
        $document->images()->saveMany($images);
        $document->save();

        return new AdminDocumentResource($document);

    }



}
