<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionAnswersUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Answer\AdminAnswerIdentifireResource;
use App\Models\Question;
use App\Models\TAnswer;
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
        $ids = $request->input('data.*.id');

        foreach ($ids as $id) {
            $answer = TAnswer::find($id);
            $question->answers()->save($answer);
        }

        return response(null, 204);
    }
}
