<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestMessagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminMessagesIdentifierResource;
use App\Models\Test;
use App\Models\TestMessage;
use http\Env\Response;
use Illuminate\Http\Request;

/**
 * Class AdminTestMessagesRelationshipsController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestMessagesRelationshipsController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Test $test)
    {
        return AdminMessagesIdentifierResource::collection($test->messages);
    }

    /**
     * @param TestMessagesUpdateRelationshipsRequest $request
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TestMessagesUpdateRelationshipsRequest $request, Test $test)
    {
        $id = $request->input('data.*.id');

        $message = TestMessage::find($id[0]);
        $message->update([
            'test_id' => $id[0]
        ]);

        return response(null, 204);
    }
}
