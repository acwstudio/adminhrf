<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentsIdentifierResource;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestCommentsRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestCommentsRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return AdminCommentCollection
     */
    public function index(Test $test)
    {
        return new AdminCommentCollection($test->comments);
    }
}
