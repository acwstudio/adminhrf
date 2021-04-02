<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HighlightCreateRequest;
use App\Http\Requests\Highlight\HighlightUpdateRequest;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Http\Resources\Admin\AdminHighlightResource;
use App\Models\Bookmark;
use App\Models\Highlight;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminHighlightController
 * @package App\Http\Controllers\Admin\Highlight
 */
class AdminHighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminHighlightCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Highlight::class)
            ->allowedIncludes(['tags', 'images'])
            ->allowedSorts(['title', 'order'])
            ->allowedFilters('type')
            ->jsonPaginate();

        return new AdminHighlightCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HighlightCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $highlight = Highlight::create($data);

        return (new AdminHighlightResource($highlight))
            ->response()
            ->header('Location', route('admin.highlights.show', [
                'highlight' => $highlight
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminHighlightResource
     */
    public function show(Highlight $highlight)
    {
        $query = QueryBuilder::for(Highlight::class)
            ->where('id', $highlight)
            ->allowedIncludes(['tags', 'images'])
            ->firstOrFail();

        return new AdminHighlightResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminHighlightResource
     */
    public function update(HighlightUpdateRequest $request, Highlight $highlight)
    {
        $data = $request->input('data.attributes');

        $highlight->update($data);

        return new AdminHighlightResource($highlight);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Highlight $highlight)
    {
        $highlight->delete();

        return response(null, 204);
    }
}
