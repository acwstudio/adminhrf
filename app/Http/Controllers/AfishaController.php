<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class AfishaController extends Controller
{
    public function index(Request $request){
        $city = $request->get('city');
        $perPage = $request->get('per_page', $this->perPage);

        if($city){
            City::where('id','=',$city)->firstOrFail()->events
                ->where('published_at','>',now())->orderBy('afisha_date','asc')->orderBy('published_at','desc');
        }
    }
}
