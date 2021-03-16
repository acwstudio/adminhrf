<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\BiographyShortResource;
use App\Http\Resources\EventShortResource;
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

        $lowerBound = Carbon::parse($request->get('start_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('end_date',now()))->format('Y-m-d');
        return  BiographyShortResource::collection(Biography::where('active', true)
            ->where('published_at', '<', now())->where('birth_date','>',$lowerBound)
            ->where('birth_date','<',$upperBound)
            ->orderBy('birth_date', 'desc')->paginate($perPage))->groupBy(function($val) {
            return Carbon::parse($val->birth_date)->format('Y-m');});
    }


    public function getEvents(Request $request){
        $perPage = $request->get('per_page', $this->perPage);

        $lowerBound = Carbon::parse($request->get('start_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('end_date',now()))->format('Y-m-d');
        return EventShortResource::collection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->where('event_date','>',$lowerBound)
            ->where('event_date','<',$upperBound)
            ->orderBy('published_at', 'desc')
            ->paginate($perPage));

    }

    public function getAll(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);

        $lowerBound = Carbon::parse($request->get('start_date','0001/01/01'))->format('Y-m-d');
        $upperBound = Carbon::parse($request->get('end_date',now()))->format('Y-m-d');

        //->get()->groupBy(function($val) {
        //                return Carbon::parse($val->birth_date)->format('Y-m');
        //            });

        $timelines = Timeline::where('date','>',$lowerBound)
                            ->where('date','<',$upperBound)->orderBy('date','desc')->paginate($perPage);

        return TimelineResource::collection($timelines);

//        $bios = BiographyShortResource::collection(Biography::where('active', true)
//            ->where('published_at', '<', now())
//            ->where('birth_date','>',$lowerBound)
//            ->where('birth_date','<',$upperBound)
//            ->orderBy('birth_date','desc')->get()->forPage($page,$perPage));
//
//        $events = EventShortResource::collection(Article::where('active', true)
//            ->where('published_at', '<', now())
//            ->where('event_date','>',$lowerBound)
//            ->where('event_date','<',$upperBound)
//            ->orderBy('event_date', 'desc')->get()->forPage($page,$perPage));
//
//        $merged = [];
//        $min = Carbon::parse(now())->format('Y-m');
//        //return $bios->merge($events)->sortByDesc('group_date');
//        $arr = $bios->merge($events); //->sortByDesc('group_date');
//
//
//        foreach ($bios->merge($events)->sortByDesc('group_date') as $item)
//        {
//            $merged[]=$item;
//        }
//
//        for ($i=0; $i<$perPage*2-2;$i++){
//            for ($j=1;$j<$perPage*2-1;$j++) {
//                if ($merged[$j]['group_date'] < $merged[$j+1]['group_date']) {
//                    [$merged[$i], $merged[$j]] = [$merged[$j], $merged[$i]];
//                }
//            }
//        }
//
//        return $merged;
////        ->get()->groupBy(function($val) {
////                return Carbon::parse($val->event_date)->format('Y-m');
////            });
//        return $merged;
//        $data = $bios->merge($events);
//
//        return $data;

    }
}
