<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\QuestionCreateRequest;
use App\Http\Requests\Question\QuestionUpdateRequest;
use App\Http\Resources\Admin\Question\AdminQuestionCollection;
use App\Http\Resources\Admin\Question\AdminQuestionResource;
use App\Models\Question;
use App\Models\TAnswer;
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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Question::class)
            ->allowedIncludes(['tests', 'answers'])
            ->allowedSorts(['id'])
            ->jsonPaginate($perPage);

        return new AdminQuestionCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QuestionCreateRequest $request)
    {
        $data = $request->input('data.attributes');
//        $dataRelAnswers = $request->input('data.relationships.answers.data.*.id');
        $dataRelTests = $request->input('data.relationships.tests.data.*.id');

        /** @var Question $question */
        $question = Question::create($data);

        if ($dataRelTests){
            $question->tests()->attach($dataRelTests);
        }

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
     * @return \App\Http\Resources\Admin\Question\AdminQuestionResource
     */
    public function show(Question $question)
    {
        $query = QueryBuilder::for(Question::class)
            ->where('id', $question->id)
            ->allowedIncludes(['tests', 'answers'])
            ->firstOrFail();

        return new AdminQuestionResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param QuestionUpdateRequest $request
     * @param Question $question
     * @return \App\Http\Resources\Admin\Question\AdminQuestionResource
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $data = $request->input('data.attributes');
//        $dataRelAnswers = $request->input('data.relationships.answers.data.*.id');
        $dataRelTests = $request->input('data.relationships.tests.data.*.id');
        $dataOldTest = $request->input('data.relationships.tests.meta.old_test');
        $idTests = $question->tests()->allRelatedIds()->toArray();

        $question->update($data);

        // Create new $dataRelTests
        foreach ($idTests as $key => $idTest){
            if ($idTest === $dataOldTest){
                $newDataRelTests = array_replace($idTests, [$key => $dataRelTests[0]]);
            }
        }

        if ($newDataRelTests) {
            $question->tests()->sync($newDataRelTests);
        }

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
        $question->answers()->delete();
        $question->delete();

        return response(null, 204);
    }
}
