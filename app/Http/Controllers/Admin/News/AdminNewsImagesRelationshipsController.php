<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsImagesRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsImagesRelationshipsController extends Controller
{
    /**
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminImagesIdentifierResource::collection($news->images);
    }

    public function update()
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
