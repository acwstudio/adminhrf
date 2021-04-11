<?php

namespace App\Http\Controllers\Admin\TestCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestCategory\TCategoriesTestsUpdateRelationshipsRequest;
use App\Http\Resources\Admin\Test\AdminTestsIdentifierResource;
use App\Models\QCategory;
use Illuminate\Http\Request;

/**
 * Class AdminTCategoriesTestsRelationshipsController
 * @package App\Http\Controllers\Admin\TestCategory
 */
class AdminTCategoriesTestsRelationshipsController extends Controller
{
    /**
     * @param QCategory $category
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(QCategory $category)
    {
        return AdminTestsIdentifierResource::collection($category->tests);
    }

    /**
     * @param TCategoriesTestsUpdateRelationshipsRequest $request
     * @param QCategory $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TCategoriesTestsUpdateRelationshipsRequest $request, QCategory $category)
    {
        return response()->json(['message' => 'Update action is disabled']);
    }
}
