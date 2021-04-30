<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timeline\TimelineCreateRequest;
use App\Http\Requests\Timeline\TimelineUpdateRequest;
use App\Http\Resources\Admin\TimeLine\AdminTimelineCollection;
use App\Http\Resources\Admin\TimeLine\AdminTimelineResource;
use App\Models\Timeline;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminTimelineController
 * @package App\Http\Controllers\Admin\Timeline
 */
class AdminTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Admin\TimeLine\AdminTimelineCollection
     * @throws AuthorizationException
     */
    public function index(request $request)
    {
        $this->authorize('manage', Timeline::class);

        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Timeline::class)
            ->allowedFilters([AllowedFilter::scope('between_date')])
            ->allowedIncludes(['timelinable'])
            ->allowedSorts(['id', 'timelinable_type'])
            ->jsonPaginate($perPage);

        return new AdminTimelineCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function store(TimelineCreateRequest $request)
    {
        $this->authorize('manage', Timeline::class);

        $data = $request->input('data.attributes');

        if (is_null(Relation::$morphMap[$data['timelinable_type']]::find($data['timelinable_id']))) {

            abort(403, 'Not found timelinable with type='.$data['timelinable_type'].' and id='.$data['timelinable_id']);

        } elseif (Timeline::where('timelinable_type', $data['timelinable_type'])->where('timelinable_id', $data['timelinable_id'])->first()) {

            abort(403, 'Timeline with type='.$data['timelinable_type'].' and id='.$data['timelinable_id'].' already exists!');

        } else {

            $timeline = Timeline::create($data);

        }

        Cache::tags(['timeline'])->flush();

        return (new AdminTimelineResource($timeline))
            ->response()
            ->header('Location', route('admin.timelines.show', [
                'timeline' => $timeline
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Timeline $timeline
     * @return AdminTimelineResource
     * @throws AuthorizationException
     */
    public function show(Timeline $timeline)
    {
        $this->authorize('manage', Timeline::class);

        $query = QueryBuilder::for(Timeline::class)
            ->where('id', $timeline->id)
            ->allowedIncludes(['timelinable'])
            ->first();

        return new AdminTimelineResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimelineUpdateRequest $request
     * @param Timeline $timeline
     * @return AdminTimelineResource
     * @throws AuthorizationException
     */
    public function update(TimelineUpdateRequest $request, Timeline $timeline)
    {
        $this->authorize('manage', Timeline::class);

        $data = collect($request->only([
            'data.attributes.date',
            'data.attributes.active',
        ]))->pull('data.attributes');

        $timeline->update($data);

        Cache::tags(['timeline'])->flush();

        return new AdminTimelineResource($timeline);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Timeline $timeline
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Timeline $timeline)
    {
        $this->authorize('manage', Timeline::class);

        $timeline->delete();

        return response(null, 204);
    }
}
