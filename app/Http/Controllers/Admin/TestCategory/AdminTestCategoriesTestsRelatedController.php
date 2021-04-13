<?php

namespace App\Http\Controllers\Admin\TestCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Test\AdminTestCollection;
use App\Models\QCategory;
use Illuminate\Http\Request;

/**
 * Class AdminTestCategoriesTestsRelatedController
 * @package App\Http\Controllers\Admin\TestCategory
 */
class AdminTestCategoriesTestsRelatedController extends Controller
{
    /**
     * @param QCategory $category
     * @return AdminTestCollection
     */
    public function index(QCategory $category)
    {
        return new AdminTestCollection($category->tests);
    }
}
