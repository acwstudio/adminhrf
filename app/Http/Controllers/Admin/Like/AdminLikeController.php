<?php

namespace App\Http\Controllers\Admin\Like;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Like\AdminLikeCollection;
use App\Models\Like;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminLikeController
 * @package App\Http\Controllers\Admin\Like
 */
class AdminLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminLikeCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Like::class)
            ->allowedSorts(['id'])
            ->jsonPaginate($perPage);

        return new AdminLikeCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
//        return $like->morphTo()->getChild()->getAttributes();
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
