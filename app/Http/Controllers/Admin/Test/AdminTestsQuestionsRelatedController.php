<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminQuestionCollection;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestsQuestionsRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestsQuestionsRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return AdminQuestionCollection
     */
    public function index(Test $test)
    {
        return new AdminQuestionCollection($test->questions);
    }
}
