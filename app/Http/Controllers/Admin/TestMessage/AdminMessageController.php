<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessage\MessageCreateRequest;
use App\Http\Requests\TestMessage\MessageUpdateRequest;
use App\Http\Resources\Admin\TestMessage\AdminMessageCollection;
use App\Http\Resources\Admin\TestMessage\AdminMessageResource;
use App\Models\TestMessage;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminMessageController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminMessageCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(TestMessage::class)
            ->allowedIncludes(['test'])
            ->allowedSorts(['title'])
            ->jsonPaginate($perPage);

        return new AdminMessageCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MessageCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $message = TestMessage::create($data);

        return (new AdminMessageResource($message))
            ->response()
            ->header('Location', route('admin.messages.show', [
                'message' => $message->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\TestMessage\AdminMessageResource
     */
    public function show(TestMessage $message)
    {
        $query = QueryBuilder::for(TestMessage::class)
            ->with('test')
            ->firstOrFail();

        return new AdminMessageResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminMessageResource
     */
    public function update(MessageUpdateRequest $request, TestMessage $message)
    {
        $data = $request->input('data.attributes');

        $message->update($data);

        return new AdminMessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TestMessage $message)
    {
        $message->delete();

        return response(null, 204);
    }
}
