<?php

namespace App\Http\Controllers;

use App\Http\Resources\AudiomaterialResource;
use App\Http\Resources\VideolectureResource;
use App\Http\Resources\VideoLectureShortResource;
use App\Models\Tag;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

class VideolectureController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = Videomaterial::where('published_at', '<', now())
                              ->where('type', '=', 'lecture')
                              ->where('active', '=', true)
                              ->with('images');
        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        return VideoLectureShortResource::collection(
                $query
                ->orderBy('published_at', 'desc')
                ->paginate($perPage));

    }


    public function show(Videomaterial $videomaterial, Request $request)
    {
        #abort_if($videomaterial->type !== 'lecture', 404, 'Idk anout such entity here');

        $videomaterial->increment('viewed');

        return VideolectureResource::make($videomaterial);
    }

    public function indexByTag(Tag $tag,Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->videomaterials()
                ->where('published_at', '<', now())
                ->where('type', '=', 'lecture')
                ->where('active', '=', true)
            ->with('images');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return VideoLectureShortResource::collection($result);
    }
}
