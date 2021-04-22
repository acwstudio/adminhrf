<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerCreateRequest;
use App\Http\Requests\Answer\AnswerUpdateRequest;
use App\Http\Resources\Admin\Answer\AdminAnswerCollection;
use App\Http\Resources\Admin\Answer\AdminAnswerResource;
use App\Http\Resources\Admin\Question\AdminQuestionResource;
use App\Models\Question;
use App\Models\TAnswer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminAnswerController
 * @package App\Http\Controllers\Admin\Answer
 */
class AdminAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Admin\Answer\AdminAnswerCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(TAnswer::class)
            ->allowedIncludes(['question'])
            ->allowedSorts(['id', 'title', 'created_at'])
            ->jsonPaginate($perPage);

        return new AdminAnswerCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AnswerCreateRequest $request)
    {
        $data = $request->input('data.attributes');
        $dataRelQuestion = $request->input('data.relationships.questions.data.*.id');

        /** @var TAnswer $answer */
        $answer = TAnswer::create($data);

//        foreach ($dataRelQuestion as $item) {
//            $question = Question::find($item);
//            $answer->question()->associate($question)->save();
//        }

        return (new AdminAnswerResource($answer))
            ->response()
            ->header('Location', route('admin.answers.show', [
                'answer' => $answer->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param TAnswer $answer
     * @return AdminAnswerResource
     */
    public function show(TAnswer $answer)
    {
        $query = QueryBuilder::for(TAnswer::class)
            ->where('id', $answer->id)
            ->allowedIncludes(['question'])
            ->firstOrFail();

        return new AdminAnswerResource($query);
    }

    /**
     * Update the specified resource in storage.
     *,
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminAnswerResource
     */
    public function update(AnswerUpdateRequest $request, TAnswer $answer)
    {
        $data = $request->input('data.attributes');
        $dataRelQuestion = $request->input('data.relationships.questions.data.*.id');

        $answer->update($data);

//        foreach ($dataRelQuestion as $item) {
//            $question = Question::find($item);
//            $answer->question()->associate($question)->save();
//        }

        return new AdminAnswerResource($answer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TAnswer $answer
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TAnswer $answer)
    {
        $answer->delete();

        return response(null, 204);
    }
}
