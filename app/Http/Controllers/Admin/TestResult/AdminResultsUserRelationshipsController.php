<?php

namespace App\Http\Controllers\Admin\TestResult;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\ResultsUserRelationshipsUpdateRequest;
use App\Http\Resources\Admin\AdminUserIdentifierResource;
use App\Models\TResult;
use Illuminate\Http\Request;

/**
 * Class AdminResultsUserRelationshipsController
 * @package App\Http\Controllers\Admin\TestResult
 */
class AdminResultsUserRelationshipsController extends Controller
{
    /**
     * @param TResult $result
     * @return AdminUserIdentifierResource
     */
    public function index(TResult $result)
    {
        return new AdminUserIdentifierResource($result->user);
    }

    /**
     * @param ResultsUserRelationshipsUpdateRequest $request
     * @param TResult $result
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ResultsUserRelationshipsUpdateRequest $request, TResult $result)
    {
        return response('обновление User для связанных результатов отключено', 405);
    }
}
