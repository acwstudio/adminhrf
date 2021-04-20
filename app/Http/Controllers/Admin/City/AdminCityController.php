<?php

namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityCreateRequest;
use App\Http\Requests\City\CityUpdateRequest;
use App\Http\Resources\Admin\City\AdminCityCollection;
use App\Http\Resources\Admin\City\AdminCityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminCityController
 * @package App\Http\Controllers\Admin\City
 */
class AdminCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminCityCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(City::class)
            ->allowedIncludes(['events'])
            ->allowedSorts('id', 'name')
            ->jsonPaginate($perPage);

        return new AdminCityCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CityCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $city = City::create($dataAttributes);

        return (new AdminCityResource($city))
            ->response()
            ->header('Location', route('admin.cities.show', [
                'city' => $city->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminCityResource
     */
    public function show(City $city)
    {
        $query = QueryBuilder::for(City::class)
            ->allowedIncludes(['events'])
            ->firstOrFail();

        return new AdminCityResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminCityResource
     */
    public function update(CityUpdateRequest $request, City $city)
    {
        $dataAttributes = $request->input('data.attributes');

        $city->update($dataAttributes);

        return new AdminCityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(City $city)
    {
        $city->events()->delete();
        $city->delete();

        return response(null, 204);
    }
}
