<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCommentsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestCommentsRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestCommentsRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminCommentsIdentifierResource::collection($test->comments);
    }

    /**
     * @param Request $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestCommentsUpdateRelationshipsRequest $request, Test $test)
    {
        return response('Обновление комментов для теста отключено', 405);
    }
}
