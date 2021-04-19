<?php

namespace App\Http\Controllers\Admin\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Requests\Timeline\TimelineCreateRequest;
use App\Http\Requests\Timeline\TimelineUpdateRequest;
use App\Http\Resources\Admin\TimeLine\AdminTimelineCollection;
use App\Http\Resources\Admin\TimeLine\AdminTimelineResource;
use App\Models\Biography;
use App\Models\Image;
use App\Models\Timeline;
use Illuminate\Http\Request;
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
     */
    public function index(request $request)
    {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TimelineCreateRequest $request)
    {
        $data = $request->input('data.attributes');
        $dataRelTimelineable = $request->input('data.relationships.timelineable.data');

        foreach ($data as $item) {
//            return $data['id'];
            $timeline = Timeline::create($item);
        }

//        $timeline = Timeline::create($data);
//
//        return (new AdminTimelineResource($timeline))
//            ->response()
//            ->header('Location', route('admin.timelines.show', [
//                'timeline' => $timeline
//            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Timeline $timeline
     * @return AdminTimelineResource
     */
    public function show(Timeline $timeline)
    {
        $query = QueryBuilder::for(Timeline::class)
            ->where('id', $timeline->id)
            ->allowedIncludes(['timelinable'])
            ->firstOrFail();

        return new AdminTimelineResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimelineUpdateRequest $request
     * @param Timeline $timeline
     * @return AdminTimelineResource
     */
    public function update(TimelineUpdateRequest $request, Timeline $timeline)
    {
        $data = $request->input('data.attributes');

        $timeline->update($data);

        return new AdminTimelineResource($timeline);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Timeline $timeline
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Timeline $timeline)
    {
        $timeline->delete();

        return response(null, 204);
    }
}
