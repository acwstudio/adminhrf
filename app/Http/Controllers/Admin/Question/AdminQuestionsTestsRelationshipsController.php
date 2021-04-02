<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionsTestsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminTestsIdentifierResource;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * Class AdminQuestionsTestsRelationshipsController
 * @package App\Http\Controllers\Admin\Question
 */
class AdminQuestionsTestsRelationshipsController extends Controller
{
    /**
     * @param Question $question
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return AdminTestsIdentifierResource::collection($question->tests);
    }

    /**
     * @param QuestionsTestsUpdateRelationshipsRequest $request
     * @param Question $question
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(QuestionsTestsUpdateRelationshipsRequest $request, Question $question)
    {
//        $ids = $request->input('data.*.id');
//        $question->tests()->sync($ids);
//
//        return response(null, 204);
        return response()->json(['message' => 'Update action is disabled']);
    }
}
