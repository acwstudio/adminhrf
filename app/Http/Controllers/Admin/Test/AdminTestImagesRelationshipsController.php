<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestImagesRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminImagesIdentifierResource::collection($test->images);
    }

    /**
     * @param TestImagesUpdateRelationshipsRequest $request
     * @param Test $test
     */
    public function update(TestImagesUpdateRelationshipsRequest $request, Test $test)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
