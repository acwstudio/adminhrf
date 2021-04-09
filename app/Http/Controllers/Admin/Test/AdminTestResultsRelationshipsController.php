<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestResultsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminResultsIdentifierResource;
use App\Models\Test;
use App\Models\TResult;
use Illuminate\Http\Request;

/**
 * Class AdminTestResultsRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestResultsRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminResultsIdentifierResource::collection($test->results);
    }

    /**
     * @param TestResultsUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestResultsUpdateRelationshipsRequest $request, Test $test)
    {
//        return response()->json(['message' => 'Update action is disabled']);

        $id = $request->input('data.*.id');

        $result = TResult::find($id[0]);

        if ($result) {
            $result->update([
                'test_id' => $test->id
            ]);
        } else {
            return response()->json(['message' => 'Test result id = ' . $id[0] . ' does not exist']);
        }

        return response(null, 204);
    }
}
