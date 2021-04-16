<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagCreateRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Http\Resources\Admin\Tag\AdminTagLightResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use App\Models\Tag;
use http\Env\Response;
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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $tags = QueryBuilder::for(Tag::class)
            ->allowedIncludes([
                'articles', 'documents', 'news', 'biographies', 'videomaterials'
            ])
            ->allowedSorts('title')
            ->jsonPaginate($perPage);

        return new AdminTagCollection($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Tag\TagCreateRequest $request
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
            ->allowedIncludes([
                'articles', 'documents', 'news', 'biographies', 'videomaterials'
            ])
            ->firstOrFail();

        return new AdminTagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Tag\TagUpdateRequest $request
     * @param Tag $tag
     * @return \App\Http\Resources\Admin\Tag\AdminTagResource
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->input('data.attributes');

        $tag->update($data);

        return new AdminTagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        return response('удаление тегов отключено', 405);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $tags = QueryBuilder::for(Tag::class)
            ->allowedSorts(['id', 'title'])
            ->get();

        return AdminTagLightResource::collection($tags);
    }
}
