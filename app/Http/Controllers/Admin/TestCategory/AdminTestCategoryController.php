<?php

namespace App\Http\Controllers\Admin\TestCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestCategory\TCategoryCreateRequest;
use App\Http\Requests\TestCategory\TCategoryUpdateRequest;
use App\Http\Resources\Admin\TestCategory\AdminTCategoryCollection;
use App\Http\Resources\Admin\TestCategory\AdminTCategoryLightResource;
use App\Http\Resources\Admin\TestCategory\AdminTCategoryResource;
use App\Models\QCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTestCategoryController
 * @package App\Http\Controllers\Admin\TestCategory
 */
class AdminTestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminTCategoryCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(QCategory::class)
            ->allowedIncludes(['tests'])
            ->allowedSorts(['id', 'text', 'position'])
            ->jsonPaginate($perPage);

        return new AdminTCategoryCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TCategoryCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $tcategory = QCategory::create($data);

        return (new AdminTCategoryResource($tcategory))
            ->response()
            ->header('Location', route('admin.test-categories.show', [
                'test_category' => $tcategory->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Admin\TestCategory\AdminTCategoryResource
     */
    public function show(QCategory $QCategory)
    {
        $query = QueryBuilder::for(QCategory::class)
            ->where('id', $QCategory->id)
            ->allowedIncludes(['tests'])
            ->firstOrFail();

        return new AdminTCategoryResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TCategoryUpdateRequest $request
     * @param QCategory $QCategory
     * @return \App\Http\Resources\Admin\TestCategory\AdminTCategoryResource
     */
    public function update(TCategoryUpdateRequest $request, QCategory $QCategory)
    {
        $data = $request->input('data.attributes');

        $QCategory->update($data);

        return new AdminTCategoryResource($QCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param QCategory $QCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(QCategory $QCategory)
    {
        if ($QCategory->tests()) {
            return response('Категория имеет связанные тесты', 405);
        }

        $QCategory->delete();

        return response(null, 204);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $categories = QueryBuilder::for(QCategory::class)
            ->allowedSorts(['id', 'text'])
            ->get();

        return AdminTCategoryLightResource::collection($categories);
    }
}
