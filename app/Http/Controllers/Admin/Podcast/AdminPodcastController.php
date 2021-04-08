<?php

namespace App\Http\Controllers\Admin\Podcast;

use App\Http\Controllers\Controller;
use App\Http\Requests\Podcast\PodcastCreateRequest;
use App\Http\Requests\Podcast\PodcastUpdateRequest;
use App\Http\Resources\Admin\AdminPodcastCollection;
use App\Http\Resources\Admin\AdminPodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminPodcastController
 * @package App\Http\Controllers\Admin\Podcast
 */
class AdminPodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminPodcastCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(Podcast::class)
            ->allowedIncludes(['tags', 'images', 'bookmarks'])
            ->allowedSorts(['id', 'title', 'order', 'created_at'])
            ->allowedFilters(['commented', 'viewed', 'liked'])
            ->jsonPaginate($perPage);

        return new AdminPodcastCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PodcastCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PodcastCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $podcast = Podcast::create($data);

        return (new AdminPodcastResource($podcast))
            ->response()
            ->header('Location', route('admin.podcasts.show', [
                'podcast' => $podcast->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Podcast $podcast
     * @return AdminPodcastResource
     */
    public function show(Podcast $podcast)
    {
        $query = QueryBuilder::for(Podcast::class)
            ->where('id', $podcast->id)
            ->allowedIncludes(['tags', 'images', 'bookmarks'])
            ->firstOrFail();

        return new AdminPodcastResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PodcastUpdateRequest $request
     * @param Podcast $podcast
     * @return AdminPodcastResource
     */
    public function update(PodcastUpdateRequest $request, Podcast $podcast)
    {
        $data = $request->input('data.attributes');

        $podcast->update($data);

        return new AdminPodcastResource($podcast);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Podcast $podcast
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return response(null, 204);
    }
}
