<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\EventImagesUpdateRelationshipsRequest;
use App\Http\Resources\Admin\AdminImagesIdentifierResource;
use App\Models\Event;
use App\Services\ImageAssignmentService;
use Illuminate\Http\Request;

/**
 * Class AdminEventImagesRelationshipsController
 * @package App\Http\Controllers\Admin\Event
 */
class AdminEventImagesRelationshipsController extends Controller
{
    /** @var ImageAssignmentService  */
    private $imageAssignment;

    /**
     * AdminTestImagesRelationshipsController constructor.
     * @param ImageAssignmentService $imageAssignment
     */
    public function __construct(ImageAssignmentService $imageAssignment)
    {
        $this->imageAssignment = $imageAssignment;
    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Event $event)
    {
        return AdminImagesIdentifierResource::collection($event->images);
    }

    /**
     * @param EventImagesUpdateRelationshipsRequest $request
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventImagesUpdateRelationshipsRequest $request, Event $event)
    {
        $Ids = $request->input('data.*.id');

        return $this->imageAssignment->assign($event, $Ids, 'afisha');
    }
}
