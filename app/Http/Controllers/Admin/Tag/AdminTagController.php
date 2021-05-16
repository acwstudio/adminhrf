<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagCreateRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\JSONAPICollection;
use App\Http\Resources\Admin\JSONAPILightResource;
use App\Http\Resources\Admin\JSONAPIResource;
use App\Http\Resources\Admin\Tag\AdminTagCollection;
use App\Http\Resources\Admin\Tag\AdminTagLightResource;
use App\Http\Resources\Admin\Tag\AdminTagResource;
use App\Models\Tag;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\QueryBuilder\AllowedFilter;
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
     * @return JSONAPICollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $tags = QueryBuilder::for(Tag::class)
            ->allowedIncludes([
                'articles', 'documents', 'news', 'biographies', 'videomaterials', 'audiomaterials'
            ])
            ->allowedSorts(['id', 'title', 'created_at'])
            ->jsonPaginate($perPage);

        return new JSONAPICollection($tags);
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

        return (new JSONAPIResource($tag))
            ->response()
            ->header('Location', route('admin.tags.show', [
                'tag' => $tag
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Tag $tag
     * @return JSONAPIResource
     */
    public function show(Tag $tag)
    {
        $tag = QueryBuilder::for(Tag::where('id', $tag->id))
            ->allowedIncludes([
                'articles', 'documents', 'news', 'biographies', 'videomaterials', 'audiomaterials'
            ])
            ->firstOrFail();

        return new JSONAPIResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Tag\TagUpdateRequest $request
     * @param Tag $tag
     * @return JSONAPIResource
     */
    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $data = $request->input('data.attributes');

        $tag->update($data);

        return new JSONAPIResource($tag);
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
//        return response('удаление тегов отключено', 405);
        $idArticles = $tag->articles()->allRelatedIds();
        $idNews = $tag->news()->allRelatedIds();
        $idDocuments = $tag->documents()->allRelatedIds();
        $idBiographies = $tag->biographies()->allRelatedIds();
        $idHighlights = $tag->highlights()->allRelatedIds();
        $idVideomaterials = $tag->videomaterials()->allRelatedIds();
        $idAudiomaterials = $tag->audiomaterials()->allRelatedIds();

        $tag->articles()->detach($idArticles);
        $tag->news()->detach($idNews);
        $tag->documents()->detach($idDocuments);
        $tag->biographies()->detach($idBiographies);
        $tag->highlights()->detach($idHighlights);
        $tag->videomaterials()->detach($idVideomaterials);
        $tag->audiomaterials()->detach($idAudiomaterials);

        $tag->delete();
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function light()
    {
        $tags = QueryBuilder::for(Tag::class)
//            ->allowedFilters([
//                'authors.title',
//                AllowedFilter::exact('articles.title')
//            ])
            ->allowedSorts(['id', 'title'])
            ->get();

        return JSONAPILightResource::collection($tags);
    }
}
