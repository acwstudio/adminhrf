<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseShortResource;
use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;
use function now;

class CourseController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function getVideocourses(Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'videocourse');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }

    public function getAudiocourses(Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'audiocourse');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }

    public function getCourses(Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'course');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }

    public function getVideocoursesByTag(Tag $tag, Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->highlights()
            ->where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'videocourse');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }

    public function getAudiocoursesByTag(Tag $tag, Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->highlights()
            ->where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'audiocourse');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }

    public function getCoursesByTag(Tag $tag, Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->highlights()
            ->where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'course');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return CourseShortResource::collection($result);
    }


    public function show(Highlight $highlight, Request $request)
    {
        return CourseResource::collection($highlight->highlightable->sortBy('event_date'));
    }
}
