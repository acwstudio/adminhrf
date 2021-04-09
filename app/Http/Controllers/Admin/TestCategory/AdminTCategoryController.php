<?php

namespace App\Http\Controllers\Admin\TestCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestCategory\TCategoryCreateRequest;
use App\Http\Requests\TestCategory\TCategoryUpdateRequest;
use App\Http\Resources\Admin\AdminTCategoryCollection;
use App\Http\Resources\Admin\AdminTCategoryLightResource;
use App\Http\Resources\Admin\AdminTCategoryResource;
use App\Models\QCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTCategoryController
 * @package App\Http\Controllers\Admin\TestCategory
 */
class AdminTCategoryController extends Controller
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
            ->allowedSorts(['text'])
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
     * @return AdminTCategoryResource
     */
    public function show(QCategory $category)
    {
        $query = QueryBuilder::for(QCategory::class)
            ->where('id', $category->id)
//            ->with('')
            ->firstOrFail();

        return new AdminTCategoryResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TCategoryUpdateRequest $request
     * @param QCategory $category
     * @return AdminTCategoryResource
     */
    public function update(TCategoryUpdateRequest $request, QCategory $category)
    {
        $data = $request->input('data.attributes');
        return QCategory::find(2);
//        $category->update($data);
//
//        return new AdminTCategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
//        return 'ok';
    }
}
