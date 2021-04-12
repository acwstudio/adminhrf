<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Answer\AdminAnswerCollection;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Class AdminQuestionAnswersRelatedController
 * @package App\Http\Controllers\Admin\Question
 */
class AdminQuestionAnswersRelatedController extends Controller
{
    /**
     * @param Question $question
     * @return AdminAnswerCollection
     */
    public function index(Question $question)
    {
        return new AdminAnswerCollection($question->answers);
    }
}
