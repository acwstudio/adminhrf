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
use Illuminate\Http\JsonResponse;
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
     * @param Request $request
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
     * @param HighlightCreateRequest $request
     * @return JsonResponse
     */
    public function store(HighlightCreateRequest $request)
    {

        $error = false;
        $messages = [];

        $data = $request->input('data.attributes');
        $highlight = Highlight::create($data);

        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        if (!empty($dataRelTags)) {
            $highlight->tags()->attach($dataRelTags);
        }

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        if (!empty($dataRelImages)) {
            $image = Image::find($dataRelImages[0]);
            if (!is_null($image) && is_null($image->imageable_id) && $image->imageable_type === 'highlight') {
                $highlight->images()->save($image);
            }
        } else {
            $error = true;
            $messages[] = 'Resource must have image relation!';
        }

        $dataRelHighlightables =  $request->input('data.relationships.highlightables.data');
        if (!empty($dataRelHighlightables)) {
            foreach ($dataRelHighlightables as $highlightable) {

                $highlight->highlightable()->create([
                    'highlightable_type' => $highlightable['type'],
                    'highlightable_id' => $highlightable['id'],
                    'is_additional' => $highlightable['is_additional'] ?? false,
                ]);

            }
        } else {
            $error = true;
            $messages[] = 'Resource must have highlightables!';
        }

        if ($error) {
            $highlight->images()->delete();
            $highlight->highlightable()->delete();
            $highlight->delete();
            abort(403, join('|', $messages));
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
     * @param Highlight $highlight
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
     * @param Request $request
     * @param  int  $id
     * @return AdminHighlightResource
     */
    public function update(HighlightUpdateRequest $request, Highlight $highlight)
    {
        $data = $request->input('data.attributes');

        $highlight->update($data);

        $dataRelTags = $request->input('data.relationships.tags.data.*.id');
        $highlight->tags()->sync($dataRelTags);

        $dataRelHighlightables =  $request->input('data.relationships.highlightables.data');
        if (!empty($dataRelHighlightables)) {

            $highlight->highlightable()->delete();

            foreach ($dataRelHighlightables as $highlightable) {

                $highlight->highlightable()->create([
                    'highlightable_type' => $highlightable['type'],
                    'highlightable_id' => $highlightable['id'],
                    'is_additional' => $highlightable['is_additional'] ?? false,
                ]);
            }
        }

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
        $highlight->tags()->sync(null);
        $highlight->images()->delete();
        $highlight->highlightable()->delete();
        $highlight->delete();

        return response(null, 204);
    }
}
