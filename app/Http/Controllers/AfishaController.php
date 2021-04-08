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
    public function index(Request $request){
        $city = $request->get('city');
        $perPage = $request->get('per_page', $this->perPage);
        $categories = $request->get('categories');

        $query = Event::where('published_at','<',now())->where('afisha_date','>',now());

        if(!is_null($city)){
            $query->where('city_id','=',City::findOrFail($city)->first()->id);
        }

        if (!is_null($categories)) {
            $params = explode('|', $categories);

            $query->whereHas('leisure', function (Builder $query) use ($params) {
                $query->whereIn('slug', $params);
            });
        }


        return AfishaShortResource::collection($query->orderBy('afisha_date','asc')
            ->orderBy('published_at','desc')->paginate($perPage));
    }

    public function categories(Request $request){
        $data['cities'] = CityResource::collection(City::where('count','>',0)->get());
        $data['leisures'] = LeisureResource::collection(Leisure::where('active',true)->where('count','>',0)->get());
        return $data;
    }


    public function show(Event $event,Request $request){
        return AfishaResource::make($event);
    }
}
