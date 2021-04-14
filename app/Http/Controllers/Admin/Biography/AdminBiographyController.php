<?php

namespace App\Http\Controllers\Admin\Biography;

use App\Http\Controllers\Controller;
use App\Http\Requests\Biography\BiographyCreateRequest;
use App\Http\Requests\Biography\BiographyUpdateRequest;
use App\Http\Resources\Admin\Biography\AdminBiographyCollection;
use App\Http\Resources\Admin\Biography\AdminBiographyResource;
use App\Models\Biography;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBiographyController
 * @package App\Http\Controllers\Admin\Biography
 */
class AdminBiographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminBiographyCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $biographies = QueryBuilder::for(Biography::class)
            ->allowedIncludes(['tags', 'bookmarks', 'categories', 'images', 'timeline'])
            ->allowedSorts(['firstname', 'surname'])
            ->jsonPaginate($perPage);

        return new AdminBiographyCollection($biographies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Biography\BiographyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BiographyCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $biography = Biography::create($data);

        return (new AdminBiographyResource($biography))
            ->response()
            ->header('Location', route('admin.biographies.show', [
                'biography' => $biography
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Biography $biography
     * @return AdminBiographyResource
     */
    public function show(Biography $biography)
    {
        $query = QueryBuilder::for(Biography::class)
            ->where('id', $biography->id)
            ->allowedIncludes(['tags', 'bookmarks', 'categories', 'images', 'timeline'])
            ->firstOrFail();

        return new AdminBiographyResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BiographyUpdateRequest $request
     * @param Biography $biography
     * @return AdminBiographyResource
     */
    public function update(BiographyUpdateRequest $request, Biography $biography)
    {
        $data = $request->input('data.attributes');

        $biography->update($data);

        return new AdminBiographyResource($biography);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Biography $biography
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Biography $biography)
    {
        $biography->delete();
        return response(null, 204);
    }
}
