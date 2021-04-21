<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestMessage\MessagesTestUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Test\AdminTestsIdentifierResource;
use App\Models\Test;
use App\Models\TestMessage;
use Illuminate\Http\Request;

/**
 * Class AdminMessagesTestRelationshipsController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessagesTestRelationshipsController extends Controller
{
    /**
     * @param TestMessage $testMessage
     * @return AdminTestsIdentifierResource
     */
    public function index(TestMessage $message)
    {
        return new AdminTestsIdentifierResource($message->test);
    }

    /**
     * @param MessagesTestUpdateRelationshipsRequest $request
     * @param TestMessage $testMessage
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(MessagesTestUpdateRelationshipsRequest $request, TestMessage $message)
    {
        $ids = $request->input('data.*.id');

        foreach ($ids as $item) {
            $test = Test::find($item);
            $message->test()->associate($test)->save();
        }

        return response(null, 204);
    }
}
