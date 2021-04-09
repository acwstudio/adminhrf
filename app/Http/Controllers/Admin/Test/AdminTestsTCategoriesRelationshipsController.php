<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestsTCategoriesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminTCategoryIdentifierResource;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestsTCategoriesRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestsTCategoriesRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminTCategoryIdentifierResource::collection($test->categories);
    }

    /**
     * @param TestsTCategoriesUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(TestsTCategoriesUpdateRelationshipsRequest $request, Test $test)
    {
        $ids = $request->input('data.*.id');
        $test->categories()->sync($ids);

        return response(null, 204);
    }
}
