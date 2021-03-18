<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\BiographyResource;
use App\Http\Resources\BiographyShortResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventShortResource;
use App\Http\Resources\TimeLineCollection;
use App\Http\Resources\TimelineResource;
use App\Models\Article;
use App\Models\Biography;
use App\Models\Timeline;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimeLineController extends Controller
{
    public function getBios(Request $request){
        $perPage = $request->get('per_page', $this->perPage);

        $lowerBound = Carbon::parse($request->get('from_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('to_date',now()))->format('Y-m-d');
        return  BiographyShortResource::collection(Biography::where('active', true)
            ->where('published_at', '<', now())
            ->whereBetween('birth_date', [$lowerBound, $upperBound])
            ->orderBy('birth_date', 'desc')->paginate($perPage))->groupBy(function($val) {
            return Carbon::parse($val->birth_date)->format('Y-m');});
    }

    public function getEvents(Request $request){
        $perPage = $request->get('per_page', $this->perPage);

        $lowerBound = Carbon::parse($request->get('from_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('to_date',now()))->format('Y-m-d');
        return EventShortResource::collection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->whereBetween('event_date', [$lowerBound, $upperBound])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage));
    }

    public function getAll(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $lowerBound = Carbon::parse($request->get('start_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('end_date',now()))->format('Y-m-d');
        $timelines = Timeline::where('date','>',$lowerBound)
                            ->where('date','<',$upperBound)->orderBy('date','desc')->paginate($perPage);

        return new TimeLineCollection($timelines);

        //return (new TimeLineCollection($timelines))->groupBy('date');
    }

    public function getEvent(Article $article,Request $request){
        return EventResource::make($article);
    }

    public function getBiography(Biography $biography,Request $request){
        return BiographyResource::make($biography);
    }
}
