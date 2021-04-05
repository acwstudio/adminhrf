<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionCreateRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Http\Resources\Admin\AdminQuestionCollection;
use App\Http\Resources\Admin\AdminQuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminQuestionController
 * @package App\Http\Controllers\Admin\Question
 */
class AdminQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminQuestionCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Question::class)
            ->with(['tests', 'answers'])
//            ->allowedIncludes(['tests', 'answers'])
            ->allowedSorts(['id'])
            ->jsonPaginate();

        return new AdminQuestionCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QuestionCreateRequest $request)
    {
        $data = $request->input('data.attributes');
//        return $data;
        $question = Question::create($data);

        return (new AdminQuestionResource($question))
            ->response()
            ->header('Location', route('admin.questions.show', [
                'question' => $question->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return AdminQuestionResource
     */
    public function show(Question $question)
    {
        $query = QueryBuilder::for(Question::class)
            ->where('id', $question->id)
            ->allowedIncludes('answers')
            ->firstOrFail();

        return new AdminQuestionResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return AdminQuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $data = $request->input('data.attributes');

        $question->update($data);

        return new AdminQuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return response(null, 204);
    }
}
