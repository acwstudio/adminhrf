<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\Admin\AdminTagCollection;
use App\Http\Resources\Admin\AdminTagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTagController
 * @package App\Http\Controllers\Admin\Tag
 */
class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminTagCollection
     */
    public function index()
    {
        $tags = QueryBuilder::for(Tag::class)
            ->with('articles')
            ->allowedSorts('title')
            ->jsonPaginate();

        return new AdminTagCollection($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $tag = Tag::create($data);

        return (new AdminTagResource($tag))
            ->response()
            ->header('Location', route('admin.tags.show', [
                'tag' => $tag
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return AdminTagResource
     */
    public function show(Tag $tag)
    {
        $tag = QueryBuilder::for(Tag::where('id', $tag->id))
            ->allowedIncludes('articles')
            ->firstOrFail();

        return new AdminTagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagUpdateRequest $request
     * @param Tag $tag
     * @return AdminTagResource
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();

        $tag->update($data['data']);

        return new AdminTagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete($tag);
        return response(null, 204);
    }
}
