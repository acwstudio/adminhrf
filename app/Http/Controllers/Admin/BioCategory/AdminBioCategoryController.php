<?php

namespace App\Http\Controllers\Admin\BioCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\BioCategory\BioCategoryCreateRequest;
use App\Http\Requests\BioCategory\BioCategoryUpdateRequest;
use App\Http\Resources\Admin\BioCategory\AdminBioCategoryCollection;
use App\Http\Resources\Admin\BioCategory\AdminBioCategoryResource;
use App\Models\BioCategory;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBioCategoryController
 * @package App\Http\Controllers\Admin\BioCategory
 */
class AdminBioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminBioCategoryCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(BioCategory::class)
            ->allowedIncludes(['biographies'])
            ->allowedSorts(['title'])
            ->jsonPaginate($perPage);

        return new AdminBioCategoryCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BioCategoryCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $biocategory = BioCategory::create($data);

        return (new AdminBioCategoryResource($biocategory))
            ->response()
            ->header('Location', route('admin.biocategories.show', [
                'biocategory' => $biocategory
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param BioCategory $bioCategory
     * @return AdminBioCategoryResource
     */
    public function show(BioCategory $biocategory)
    {
        $query = QueryBuilder::for(BioCategory::class)
            ->where('id', $biocategory->id)
            ->allowedIncludes(['biographies'])
            ->firstOrFail();

        return new AdminBioCategoryResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminBioCategoryResource
     */
    public function update(BioCategoryUpdateRequest $request, BioCategory $biocategory)
    {
        $data = $request->input('data.attributes');

        $biocategory->update($data);

        return new AdminBioCategoryResource($biocategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BioCategory $biocategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(BioCategory $biocategory)
    {
        $biocategory->biographies()->detach();

        $biocategory->delete();

        return response(null, 204);
    }
}
