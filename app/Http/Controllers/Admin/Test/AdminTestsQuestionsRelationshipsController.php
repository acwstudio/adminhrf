<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestsQuestionsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminQuestionsIdentifireResource;
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
     * @return AdminQuestionsIdentifireResource
     */
    public function index(Test $test)
    {
        return new AdminQuestionsIdentifireResource($test->questions);
    }

    /**
     * @param TestsQuestionsUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestsQuestionsUpdateRelationshipsRequest $request, Test $test)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
