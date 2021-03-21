<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmsResource;
use App\Http\Resources\FilmsShortResource;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    public function index(Request $request){
        $perPage = $request->get('per_page', 16);
        return FilmsShortResource::collection(
            Film::where('published_at','<',now())
                ->where('active','=',true)
                ->with('images')
                ->orderBy('published_at','desc')
                ->paginate($perPage));
        //Film::
    }


    public function show(Film $film,Request $request){
        return FilmsResource::make($film);
    }
}
