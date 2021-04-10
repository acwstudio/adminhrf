<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionAnswersUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Answer\AdminAnswerIdentifireResource;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Class AdminQuestionAnswersRelationshipsController
 * @package App\Http\Controllers\Admin\Question
 */
class AdminQuestionAnswersRelationshipsController extends Controller
{
    /**
     * @param Question $question
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return AdminAnswerIdentifireResource::collection($question->answers);
    }

    /**
     * @param QuestionAnswersUpdateRelationshipsRequest $request
     * @param Question $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(QuestionAnswersUpdateRelationshipsRequest $request, Question $question)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
