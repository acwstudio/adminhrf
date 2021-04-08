<?php

namespace App\Http\Controllers\Admin\TestResult;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminTestCollection;
use App\Http\Resources\Admin\AdminTestResource;
use App\Models\TResult;
use Illuminate\Http\Request;

/**
 * Class AdminResultsTestRelatedController
 * @package App\Http\Controllers\Admin\TestResult
 */
class AdminResultsTestRelatedController extends Controller
{
    /**
     * @param TResult $result
     * @return AdminTestresource
     */
    public function index(TResult $result)
    {
        return new AdminTestResource($result->test);
    }
}
