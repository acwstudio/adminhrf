<?php

namespace App\Http\Controllers\Admin\TestResult;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestResult\ResultCreateRequest;
use App\Http\Requests\TestResult\ResultUpdateRequest;
use App\Http\Resources\Admin\TestResult\AdminResultCollection;
use App\Http\Resources\Admin\TestResult\AdminResultResource;
use App\Models\TResult;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminResultController
 * @package App\Http\Controllers\Admin\TestResult
 */
class AdminResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Admin\TestResult\AdminResultCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(TResult::class)
            ->allowedIncludes(['test', 'user'])
            ->allowedFilters([
                AllowedFilter::exact('user', 'user_id'),
                AllowedFilter::exact('test', 'test_id')
            ])
            ->jsonPaginate($perPage);

        return new AdminResultCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ResultCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $result = TResult::create($data);

        return (new AdminResultResource($result))
            ->response()
            ->header('Location', route('admin.results.show', [
                'result' => $result->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminResultResource
     */
    public function show(TResult $result)
    {
        $query = QueryBuilder::for(TResult::class)
            ->where('id', $result->id)
            ->allowedIncludes(['test', 'user'])
            ->firstOrFail();

        return new AdminResultResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\Admin\TestResult\AdminResultResource
     */
    public function update(ResultUpdateRequest $request, TResult $result)
    {
        $data = $request->input('data.attributes');

        $result->update($data);

        return new AdminResultResource($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TResult $result
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TResult $result)
    {
        $result->delete();

        return response(null, 204);
    }
}
