<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseShortResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getVideocourses(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return CourseShortResource::collection(Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'videocourse')
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function getAudiocourses(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return CourseShortResource::collection(Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'audiocourse')
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function getCourses(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return CourseShortResource::collection(Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'course')
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function show(Highlight $highlight)
    {
        return CourseResource::collection($highlight->highlightable->sortBy('event_date'));
    }
}
