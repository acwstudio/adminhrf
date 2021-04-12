<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Test\AdminTestCollection;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Class AdminQuestionsTestsRelatedController
 * @package App\Http\Controllers\Admin\Question
 */
class AdminQuestionsTestsRelatedController extends Controller
{
    /**
     * @param Question $question
     * @return \App\Http\Resources\Admin\Test\AdminTestCollection
     */
    public function index(Question $question)
    {
        return new AdminTestCollection($question->tests);
    }
}
