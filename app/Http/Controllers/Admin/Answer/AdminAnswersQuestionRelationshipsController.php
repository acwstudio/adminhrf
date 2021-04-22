<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswersQuestionUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Question\AdminQuestionsIdentifireResource;
use App\Models\Question;
use App\Models\TAnswer;
use Illuminate\Http\Request;

/**
 * Class AdminAnswersQuestionRelationshipsController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswersQuestionRelationshipsController extends Controller
{
    /**
     * @param TAnswer $answer
     * @return AdminQuestionsIdentifireResource
     */
    public function index(TAnswer $answer)
    {
        return new AdminQuestionsIdentifireResource($answer->question);
    }

    /**
     * @param AnswersQuestionUpdateRelationshipsRequest $request
     * @param TAnswer $answer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(AnswersQuestionUpdateRelationshipsRequest $request, TAnswer $answer)
    {
        $id = $request->input('data.id');

        $answer->update(['question_id' => $id]);

        return response(null, 204);
    }
}
