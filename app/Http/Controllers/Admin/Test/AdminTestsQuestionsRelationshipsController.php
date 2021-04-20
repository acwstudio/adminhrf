<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestsQuestionsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Question\AdminQuestionsIdentifireResource;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestsQuestionsRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestsQuestionsRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminQuestionsIdentifireResource::collection($test->questions);
    }

    /**
     * @param TestsQuestionsUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestsQuestionsUpdateRelationshipsRequest $request, Test $test)
    {
        $ids = $request->input('data.*.id');
        $test->questions()->sync($ids);

        return response(null, 204);
    }
}
