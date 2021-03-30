<?php

namespace App\Http\Controllers\Admin\Answer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerCreateRequest;
use App\Http\Requests\Answer\AnswerUpdateRequest;
use App\Http\Resources\Admin\AdminAnswerCollection;
use App\Http\Resources\Admin\AdminAnswerResource;
use App\Http\Resources\Admin\AdminQuestionResource;
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
     * @return AdminAnswerCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(TAnswer::class)
            ->with('question')
//            ->allowedIncludes([''])
//            ->allowedSorts([''])
            ->jsonPaginate();

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

        $answer = TAnswer::create($data);

        return (new AdminAnswerResource($answer))
            ->response()
            ->header('Location', route('admin.answers.show', [
                'answer' => $answer->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminQuestionResource
     */
    public function show(TAnswer $answer)
    {
        $query = QueryBuilder::for(TAnswer::class)
            ->where('id', $answer->id)
            ->allowedIncludes(['questions'])
            ->firstOrFail();

        return new AdminQuestionResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminAnswerResource
     */
    public function update(AnswerUpdateRequest $request, TAnswer $answer)
    {
        $data = $request->input('data.attributes');

        $answer->update($data);

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
