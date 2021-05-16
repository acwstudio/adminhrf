<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\HighlightResource;
use App\Http\Resources\Site\HighlightShortResource;
use App\Http\Resources\Site\ImageResource;
use App\Models\Highlight;
use App\Models\Tag;
use Illuminate\Http\Request;
use function now;

class HighlightController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $sortBy = $request->get('sort_by');
        $query = Highlight::where('active', '=', true)
            ->where('published_at', '<', now())
            ->where('type', '=', 'highlight');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        return HighlightShortResource::collection($query
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function show(Highlight $highlight, Request $request)
    {
        $highlight->increment('viewed');
        return
            [
                'data' => HighlightResource::collection($highlight->highlightable->sortBy('order')),
                'image' => $highlight->images ? ImageResource::make($highlight->images->first()) : null,
                'highlight' => HighlightShortResource::make($highlight)
            ];
    }


    public function indexByTag(Tag $tag, Request $request)
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
