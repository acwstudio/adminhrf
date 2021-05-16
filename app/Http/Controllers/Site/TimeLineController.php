<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\BiographyResource;
use App\Http\Resources\Site\BiographyShortResource;
use App\Http\Resources\Site\EventResource;
use App\Http\Resources\Site\EventShortResource;
use App\Http\Resources\Site\TimeLineCollection;
use App\Models\Article;
use App\Models\Biography;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use function config;

class TimeLineController extends Controller
{


    public function getAll(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);


        $query = Timeline::whereYear('date', '>=', $request->get('start_year', 1900))
            ->whereYear('date', '<=', $request->get('end_year', 1999))
            ->orderBy('date', 'asc');


        if (config('cache.enabled')) {

            $result = Cache::tags(['timeline'])
                ->remember("query-{$request->fullUrl()}", $this->cacheTime, function () use ($query, $perPage) {
                    return $query->paginate($perPage);
                });

            if (!$request->user()) {

                return Cache::tags(['timeline'])
                    ->remember("resource-{$request->fullUrl()}", $this->cacheTime, function () use ($result) {
                        return new TimeLineCollection($result);
                    });
            }

        } else {

            $result = $query->paginate($perPage);
        }


        return new TimeLineCollection($result);


    }

    public function getEvent(Article $article, Request $request)
    {
        return EventResource::make($article);
    }

    public function getBiography(Biography $biography, Request $request)
    {
        return BiographyResource::make($biography);
    }
}
