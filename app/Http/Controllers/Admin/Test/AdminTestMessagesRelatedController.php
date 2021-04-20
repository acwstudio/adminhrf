<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TestMessage\AdminMessageCollection;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestMessagesRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestMessagesRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return \App\Http\Resources\Admin\TestMessage\AdminMessageCollection
     */
    public function index(Test $test)
    {
        return new AdminMessageCollection($test->messages);
    }
}
