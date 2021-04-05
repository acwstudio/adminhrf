<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HihglightImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

/**
 * Class AdminHighlightImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightImagesRelationshipsController extends Controller
{
    /**
     * @param Highlight $highlight
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Highlight $highlight)
    {
        return AdminImagesIdentifierResource::collection($highlight->images);
    }

    /**
     * @param HihglightImagesUpdateRelationshipsRequest $request
     * @param Highlight $highlight
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HihglightImagesUpdateRelationshipsRequest $request, Highlight $highlight)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
