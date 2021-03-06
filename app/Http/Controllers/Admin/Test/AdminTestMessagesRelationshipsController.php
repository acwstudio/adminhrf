<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestMessagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\TestMessage\AdminMessagesIdentifierResource;
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
        $ids = $request->input('data.*.id');

        foreach ($ids as $id) {
            $message = TestMessage::find($id);
            $test->messages()->save($message);
        }

        return response(null, 204);

    }
}
