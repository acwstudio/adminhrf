<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Like\AdminLikeIdentifierResource;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestLikesRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestLikesRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminLikeIdentifierResource::collection($test->likes);
    }

    /**
     * @param Request $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Test $test)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
