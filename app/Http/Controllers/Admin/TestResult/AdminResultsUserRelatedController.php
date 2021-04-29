<?php

namespace App\Http\Controllers\Admin\TestResult;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\AdminUserResource;
use App\Models\TResult;

/**
 * Class AdminResultsUserRelatedController
 * @package App\Http\Controllers\Admin\TestResult
 */
class AdminResultsUserRelatedController extends Controller
{
    /**
     * @param TResult $result
     * @return AdminUserResource
     */
    public function index(TResult $result)
    {
        return new AdminUserResource($result->user);
    }
}
