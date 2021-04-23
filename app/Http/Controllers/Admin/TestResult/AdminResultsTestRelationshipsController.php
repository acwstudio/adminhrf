<?php

namespace App\Http\Controllers\Admin\TestResult;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\ResultsTestRelationshipsUpdateRequest;
use App\Http\Resources\Admin\TestResult\AdminResultsIdentifierResource;
use App\Http\Resources\Admin\Test\AdminTestsIdentifierResource;
use App\Models\Test;
use App\Models\TResult;
use Illuminate\Http\Request;

/**
 * Class AdminResultsTestRelationshipsController
 * @package App\Http\Controllers\Admin\TestResult
 */
class AdminResultsTestRelationshipsController extends Controller
{
    /**
     * @param TResult $result
     * @return AdminTestsIdentifierResource
     */
    public function index(TResult $result)
    {
        return new AdminTestsIdentifierResource($result->test);
    }

    /**
     * @param ResultsTestRelationshipsUpdateRequest $request
     * @param TResult $result
     */
    public function update(ResultsTestRelationshipsUpdateRequest $request, Tresult $result)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $item) {
            $test = Test::find($item);
            $result->test()->associate($test)->save();
        }

        return response(null, 204);
    }
}
