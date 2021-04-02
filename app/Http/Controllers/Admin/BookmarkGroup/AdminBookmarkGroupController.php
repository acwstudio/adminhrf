<?php

namespace App\Http\Controllers\Admin\BookmarkGroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookmarkGroup\BookmarkGroupCreateRequest;
use App\Http\Requests\BookmarkGroup\BookmarkGroupUpdateRequest;
use App\Http\Resources\Admin\AdminBookmarkGroupCollection;
use App\Http\Resources\Admin\AdminBookmarkGroupResource;
use App\Models\BookmarkGroup;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBookmarkGroupController
 * @package App\Http\Controllers\Admin\BookmarkGroup
 */
class AdminBookmarkGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminBookmarkGroupCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(BookmarkGroup::class)
//            ->allowedIncludes('')
//            ->allowedSorts()
            ->jsonPaginate();

        return new AdminBookmarkGroupCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookmarkGroupCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $bookmarkGroup = BookmarkGroup::create($data);

        return (new AdminBookmarkGroupResource($bookmarkGroup))
            ->response()
            ->header('Location', route('admin.bookmark-groups.show', [
                'bookmark_group' => $bookmarkGroup->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BookmarkGroup $bookmarkGroup)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookmarkGroupUpdateRequest $request, BookmarkGroup $bookmarkGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookmarkGroup $bookmarkGroup)
    {
        //
    }
}
