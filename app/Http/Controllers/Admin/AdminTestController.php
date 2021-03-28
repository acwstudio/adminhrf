<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestCreateRequest;
use App\Http\Resources\Admin\AdminTestCollection;
use App\Http\Resources\Admin\AdminTestResource;
use App\Models\Test;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTestController
 * @package App\Http\Controllers\Admin
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
//            ->with()
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
//        $data = $request->input('data');
//        return $data;
        $test = Test::create($dataAttributes);

        $query = QueryBuilder::for(Test::with('images')
            ->where('id', $test->id))
            ->firstOrFail();

        return (new AdminTestResource($query))
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
        $query = QueryBuilder::for(Test::with('images')
            ->where('id', $test->id))
            ->firstOrFail();

        return new AdminTestResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
