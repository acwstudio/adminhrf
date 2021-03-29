<?php

namespace App\Http\Controllers;

use App\Http\Resources\AfishaResource;
use App\Http\Resources\AfishaShortResource;
use App\Models\City;
use App\Models\Event;
use Illuminate\Http\Request;

class AfishaController extends Controller
{
    public function index(Request $request){
        $city = $request->get('city');
        $perPage = $request->get('per_page', $this->perPage);

        if($city){
            return City::where('id','=',$city)->firstOrFail()->events()
                ->where('published_at','>',now())->orderBy('afisha_date','asc')
                    ->orderBy('published_at','desc')->paginate($perPage);
        }
        return AfishaShortResource::collection(Event::where('published_at','>',now())->orderBy('afisha_date','asc')
            ->orderBy('published_at','desc')->paginate($perPage));
    }


    public function show(Event $event,Request $request){
        return AfishaResource::make($event);
    }
}
