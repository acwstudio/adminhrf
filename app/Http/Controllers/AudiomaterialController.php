<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\AudiomaterialResource;
use App\Http\Resources\AudiomaterialShortResource;
use App\Models\Audiomaterial;
use App\Models\Tag;
use Illuminate\Http\Request;

class AudiomaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $sortBy = $request->get('sort_by');
        $query = Audiomaterial::with('highlights')
                              ->whereNull('parent_id');
        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }
        $audio =  $query
            ->orderBy('position')
            ->paginate($perPage);

        return AudiomaterialShortResource::collection($audio);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audiomaterial  $audio
     * @return AudiomaterialResource
     */
    public function show(Audiomaterial $audio)
    {
        $audio->increment('viewed');

        return AudiomaterialResource::make($audio->load('highlights'));
    }

    public function indexByTag(Tag $tag,Request $request)
    {

        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');

        $query = $tag->audiomaterials()
            ->where('active', true)
            ->where('published_at', '<', now())
            ->with('images');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $result = $query->orderBy('published_at', 'desc')
            ->paginate($perPage);

        return AudiomaterialShortResource::collection($result);
    }

}
