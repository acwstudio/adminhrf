<?php

namespace App\Http\Controllers;

use App\Http\Resources\AudiomaterialResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseShortResource;
use App\Http\Resources\HighlightResource;
use App\Http\Resources\HighlightShortResource;
use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;

class HighlightController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $sortBy = $request->get('sort_by');
        $query = Highlight::where('active','=', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'highlight');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        return HighlightShortResource::collection($query
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function show(Highlight $highlight,Request $request)
    {
        return HighlightResource::collection($highlight->highlightable->sortBy('event_date'));
    }


    public function indexByTag(Tag $tag,Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->highlights()
            ->where('active', true)
            ->where('type', '=', 'highlight');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return HighlightShortResource::collection($result);
    }


}
