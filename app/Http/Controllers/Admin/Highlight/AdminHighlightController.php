<?php

namespace App\Http\Controllers\Admin\Highlight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Highlight\HighlightCreateRequest;
use App\Http\Requests\Highlight\HighlightUpdateRequest;
use App\Http\Resources\Admin\AdminHighlightCollection;
use App\Http\Resources\Admin\AdminHighlightResource;
use App\Models\Bookmark;
use App\Models\Highlight;
use App\Models\Image;
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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(Highlight::class)
            ->allowedIncludes(['tags', 'images', 'highlightable'])
            ->allowedSorts(['title', 'order'])
            ->allowedFilters('type')
            ->jsonPaginate($perPage);

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
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelHighlightables =  $request->input('data.relationships.highlightables.data');

//        dd($data, $dataRelTags, $dataRelImages, $dataRelHighlightables);

        $highlight = Highlight::create($data);
        $highlight->tags()->attach($dataRelTags);

        $image = Image::find($dataRelImages[0]);
        if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'highlight') {
            $highlight->images()->save($image);
        }

        foreach ($dataRelHighlightables as $highlightable) {

            $created = $highlight->highlightable()->create([
                'highlightable_type' => $highlightable['type'],
                'highlightable_id' => $highlightable['id'],
                'is_additional' => $highlightable['is_additional'] ?? false,
            ]);

        }

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
            ->where('id', $highlight->id)
            ->allowedIncludes(['tags', 'images', 'highlightable'])
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
