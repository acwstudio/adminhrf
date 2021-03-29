<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestCreateRequest;
use App\Http\Requests\Test\TestUpdateRequest;
use App\Http\Resources\Admin\AdminTestCollection;
use App\Http\Resources\Admin\AdminTestResource;
use App\Models\Test;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTestController
 * @package App\Http\Controllers\Admin\Test
 */
class AdminTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminTestCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
//        $this->authorize('manage', Test::class);

        $query = QueryBuilder::for(Test::class)
            ->allowedIncludes(['images', 'comments'])
            ->allowedSorts('title', 'created_at')
            ->jsonPaginate();

        return new AdminTestCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TestCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $test = Test::create($dataAttributes);

        return (new AdminTestResource($test))
            ->response()
            ->header('Location', route('admin.tests.show', [
                'test' => $test->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return AdminTestResource
     */
    public function show(Test $test)
    {
        $query = QueryBuilder::for(Test::class)
            ->where('id', $test->id)
            ->allowedIncludes(['images', 'comments'])
            ->firstOrFail();

        return new AdminTestResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminTestResource
     */
    public function update(TestUpdateRequest $request, Test $test)
    {
        $data = $request->input('data.attributes');

        $test->update($data);

        return new AdminTestResource($test);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return response(null, 204);

    }
}
