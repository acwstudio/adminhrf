<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TestResult\AdminResultCollection;
use App\Models\Test;

/**
 * Class AdminTestResultsRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestResultsRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return \App\Http\Resources\Admin\TestResult\AdminResultCollection
     */
    public function index(Test $test)
    {
        return new AdminResultCollection($test->results);
    }
}
