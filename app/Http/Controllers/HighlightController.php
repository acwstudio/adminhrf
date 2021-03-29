<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseShortResource;
use App\Http\Resources\HighlightResource;
use App\Http\Resources\HighlightShortResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        return HighlightShortResource::collection(Highlight::where('active', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'highlight')
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function show(Highlight $highlight,Request $request)
    {
        return HighlightResource::collection($highlight->highlightable->sortBy('event_date'));
    }
}
