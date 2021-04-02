<?php

namespace App\Http\Controllers;

use App\Http\Resources\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];


    /**
     *
     * Display paginated listing of articles.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function index(Request $request)
    {

        $perPage = $request->get('per_page', 8);
        $sortBy = $request->get('sort_by');

        $query = Podcast::with('images');

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        } else {
            $query->orderBy('order');
        }

        $result = $query->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return PodcastResource::collection($result);
    }

    /**
     * Display article by id.
     *
     * @param Podcast $podcast
     * @return PodcastResource
     */
    public function show(Podcast $podcast)
    {
        return PodcastResource::make($podcast);
    }
}
