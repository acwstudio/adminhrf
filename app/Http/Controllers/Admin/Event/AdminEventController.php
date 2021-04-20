<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventCreateRequest;
use App\Http\Requests\Event\EventUpdateRequest;
use App\Http\Resources\Admin\Event\AdminEventCollection;
use App\Http\Resources\Admin\Event\AdminEventResource;
use App\Models\Event;
use App\Models\Image;
use App\Services\ImageAssignmentService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminEventController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventController extends Controller
{
    /** @var ImageService  */
    private $imageService;

    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminArticleController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService, ImageAssignmentService $imageAssignment)
    {
        $this->imageService = $imageService;
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AdminEventCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Event::class)
            ->allowedIncludes([
                'images','leisure','city','likes','bookmarks','comments'
            ])
            ->jsonPaginate($perPage);

        return new AdminEventCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventCreateRequest $request)
    {
        $dataAttributes = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $event = Event::create($dataAttributes);

        if ($dataRelImages) {
            /** @see ImageAssignmentService creates a relationship Image to Event */
            $this->imageAssignment->assign($event, $dataRelImages, 'event');
        }

        return (new AdminEventResource($event))
            ->response()
            ->header('Location', route('admin.events.show', [
                "event" => $event->id
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminEventResource
     */
    public function show(Event $event)
    {
        $query = QueryBuilder::for(Event::class)
            ->where('id', $event->id)
            ->firstOrFail();

        return new AdminEventResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EventUpdateRequest $request
     * @param Event $event
     * @return AdminEventResource
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $dataAttributes = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');

        $event->update($dataAttributes);

//        if ($dataRelImages) {
//            /** @see ImageAssignmentService creates a relationship Image to Event */
//            $this->imageAssignment->assign($event, $dataRelImages, 'afisha');
//        }

        return new AdminEventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $images = Image::where('imageable_id', $event->id)
            ->where('imageable_type', 'article')->get();

        foreach ($images as $image) {
            $this->imageService->delete($image);
        }

        $event->images()->delete();
        $event->comments()->delete();
        $event->bookmarks()->delete();

        $event->delete();

        return response(null, 204);
    }
}
