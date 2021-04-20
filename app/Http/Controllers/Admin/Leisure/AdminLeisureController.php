<?php

namespace App\Http\Controllers\Admin\Leisure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Leisure\LeisureCreateRequest;
use App\Http\Requests\Leisure\LeisureUpdateRequest;
use App\Http\Resources\Admin\Leisure\AdminLeisureCollection;
use App\Http\Resources\Admin\Leisure\AdminLeisureResource;
use App\Models\Leisure;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminLeisureController
 * @package App\Http\Controllers\Admin\Leisure
 */
class AdminLeisureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminLeisureCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Leisure::class)
            ->allowedIncludes(['events'])
            ->allowedSorts('id', 'title')
            ->jsonPaginate($perPage);

        return new AdminLeisureCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(LeisureCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $leisure = Leisure::create($dataAttributes);

        return (new AdminLeisureResource($leisure))
            ->response()
            ->header('Location', route('admin.leisures.show', [
                'leisure' => $leisure->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminLeisureResource
     */
    public function show(Leisure $leisure)
    {
        $query = QueryBuilder::for(Leisure::class)
            ->where('id', $leisure->id)
            ->allowedIncludes(['events'])
            ->firstOrFail();

        return new AdminLeisureResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LeisureUpdateRequest $request
     * @param Leisure $leisure
     * @return AdminLeisureResource
     */
    public function update(LeisureUpdateRequest $request, Leisure $leisure)
    {
        $dataAttributes = $request->input('data.attributes');

        $leisure->update($dataAttributes);

        return new AdminLeisureResource($leisure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Leisure $leisure
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Leisure $leisure)
    {
        $leisure->delete();

        return response(null, 204);
    }
}
