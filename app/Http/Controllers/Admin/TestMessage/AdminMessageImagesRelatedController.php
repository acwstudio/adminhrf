<?php

namespace App\Http\Controllers\Admin\TestMessage;

use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\TestMessage;
use App\Http\Controllers\{Controller};
use Illuminate\Http\Request;

/**
 * Class AdminMessageImagesRelatedController
 * @package App\Http\Controllers\Admin\TestMessage
 */
class AdminMessageImagesRelatedController extends Controller
{
    /**
     * @param TestMessage $testMessage
     * @return AdminImageCollection
     */
    public function index(TestMessage $message)
    {
        return new AdminImageCollection($message->images);
    }
}
