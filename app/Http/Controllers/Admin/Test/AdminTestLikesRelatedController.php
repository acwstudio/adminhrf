<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Like\AdminLikeCollection;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestLikesRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestLikesRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return AdminLikeCollection
     */
    public function index(Test $test)
    {
        return new AdminLikeCollection($test->likes);
    }
}
