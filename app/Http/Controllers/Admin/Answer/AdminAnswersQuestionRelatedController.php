<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Question\AdminQuestionResource;
use App\Models\TAnswer;
use Illuminate\Http\Request;

/**
 * Class AdminAnswersQuestionRelationshipsController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswersQuestionRelatedController extends Controller
{
    /**
     * @param TAnswer $answer
     * @return \App\Http\Resources\Admin\Question\AdminQuestionResource
     */
    public function index(TAnswer $answer)
    {
        return new AdminQuestionResource($answer->question);
    }
}
