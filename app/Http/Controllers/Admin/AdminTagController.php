<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\Admin\AdminTagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return AdminTagResource::collection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagCreateRequest $request)
    {
        $data = $request->validated();

        $tag = Tag::create($data['data']);

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
