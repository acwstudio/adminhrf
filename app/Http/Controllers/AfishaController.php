<?php

namespace App\Http\Controllers;

use App\Http\Resources\AfishaResource;
use App\Http\Resources\AfishaShortResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\LeisureResource;
use App\Models\City;
use App\Models\Event;
use App\Models\Leisure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AfishaController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->get('city');
        $perPage = $request->get('per_page', $this->perPage);
        $categories = $request->get('categories');

        $query = Event::where('published_at', '<', now())->where('afisha_date', '>', now());

        if (!is_null($city)) {
            $query->where('city_id', '=', City::findOrFail($city)->first()->id);
        }

        if (!is_null($categories)) {
            $params = explode('|', $categories);

            $query->whereHas('leisure', function (Builder $query) use ($params) {
                $query->whereIn('slug', $params);
            });
        }


        return AfishaShortResource::collection($query->orderBy('afisha_date', 'asc')
            ->orderBy('published_at', 'desc')->paginate($perPage));
    }

    public function categories(Request $request)
    {
        $data['cities'] = CityResource::collection(City::where('count', '>', 0)->get());
        $data['leisures'] = LeisureResource::collection(Leisure::where('active', true)->where('count', '>', 0)->get());
        return $data;
    }


    public function show(Event $event, Request $request)
    {
        return AfishaResource::make($event);
    }

    public function old(Request $request)
    {
        $city = $request->get('city');
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $categories = $request->get('categories');

        //$query = Event::where('published_at', '<', now())->where('afisha_date', '>', now())
          //  ->orderBy('afisha_date', 'asc')->orderBy('published_at', 'asc')->get();
        $query = Event::where('published_at', '<', now())->where('afisha_date', '>', now())
            ->orderBy('afisha_date', 'asc')->get();
       // $old = Event::where('afisha_date', '<', now())->orderBy('afisha_date', 'desc');
//        foreach ($old as $el){
//            $el->is_new = false;
//        }
//        foreach ($query as $row){
//            $row->is_new = true;
//        }
//        if (!is_null($city)) {
//            $query->where('city_id', '=', City::findOrFail($city)->first()->id);
//        }
//
//        if (!is_null($categories)) {
//            $params = explode('|', $categories);
//
//            $query->whereHas('leisure', function (Builder $query) use ($params) {
//                $query->whereIn('slug', $params);
//            });
//        }

        $arr = $query->merge(Event::where('afisha_date', '<', now())->orderBy('afisha_date', 'desc')->get()); //->get()
        $total = $arr->count();
        $count = ceil($total/$perPage);
        return
            [
                'data' => AfishaShortResource::collection($arr->forPage($page,$perPage)),
                'meta' => [
                    'current_page' => (int)$page,
                    'from' => 1+($page-1)*$count,
                    'page' => (int)$page,
                    'last_page' => $count,
                    'total' => $total,
                    'to' => 1+$page*$count,
                ]
            ];
    }
}
