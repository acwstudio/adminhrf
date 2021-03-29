<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminImageCollection;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestImagesRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestImagesRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return AdminImageCollection
     */
    public function index(Test $test)
    {
        return new AdminImageCollection($test->images);
    }
}
