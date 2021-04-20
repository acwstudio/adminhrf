<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\TestCategory\AdminTCategoryCollection;
use App\Models\Test;
use Illuminate\Http\Request;

/**
 * Class AdminTestsTCategoriesRelatedController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestsTCategoriesRelatedController extends Controller
{
    /**
     * @param Test $test
     * @return AdminTCategoryCollection
     */
    public function index(Test $test)
    {
        return new AdminTCategoryCollection($test->categories);
    }
}
