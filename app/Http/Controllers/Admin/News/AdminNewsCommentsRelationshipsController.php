<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\News;
use Illuminate\Http\Request;

/**
 * Class AdminNewsCommentsRelationshipsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsCommentsRelationshipsController extends Controller
{
    /**
     * @param News $news
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(News $news)
    {
        return AdminCommentsIdentifierResource::collection($news->comments);
    }

    public function update()
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
