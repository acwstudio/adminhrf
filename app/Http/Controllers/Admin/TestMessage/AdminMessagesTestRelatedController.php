<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Test\AdminTestResource;
use App\Models\TestMessage;
use Illuminate\Http\Request;

/**
 * Class AdminMessagesTestRelatedController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessagesTestRelatedController extends Controller
{
    /**
     * @param TestMessage $testMessage
     * @return AdminTestResource
     */
    public function index(TestMessage $message)
    {
        return new AdminTestResource($message->test);
    }
}
