<?php

namespace App\Http\Controllers\Admin\Bookmark;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bookmark\BookmarkCreateRequest;
use App\Http\Requests\Bookmark\BookmarkUpdateRequest;
use App\Http\Resources\Admin\AdminBookmarkCollection;
use App\Http\Resources\Admin\AdminBookmarkResource;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminBookmarkController
 * @package App\Http\Controllers\Admin\Bookmark
 */
class AdminBookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminBookmarkCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(Bookmark::class)
            ->jsonPaginate($perPage);

        return new AdminBookmarkCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BookmarkCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $bookmark = Bookmark::create($data);

        return (new AdminBookmarkResource($bookmark))
            ->response()
            ->header('Location', route('admin.bookmarks.show', [
                'bookmark' => $bookmark
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminBookmarkResource
     */
    public function show(Bookmark $bookmark)
    {
        $query = QueryBuilder::for(Bookmark::class)
            ->where('id', $bookmark->id)
            ->firstOrFail();

        return new AdminBookmarkResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminBookmarkResource
     */
    public function update(BookmarkUpdateRequest $request, Bookmark $bookmark)
    {
        $data = $request->input('data.attributes');

        $bookmark->update($data);

        return new AdminBookmarkResource($bookmark);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bookmark $bookmark
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();

        return response(null, 204);
    }
}
