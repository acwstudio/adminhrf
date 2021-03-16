<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\BiographyShortResource;
use App\Models\Article;
use App\Models\Biography;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    public function getBios(Request $request){
        $perPage = $request->get('per_page', $this->perPage);

        $lowerBound = date_format(new \DateTime($request->get('start_date', '01/01/0001')),'Y-m-d');
        $upperBound = date_format(new \DateTime($request->get('end_date', now())),'Y-m-d');

        return  BiographyShortResource::collection(Biography::where('active', true)
            ->where('published_at', '<', now())->where('birth_date','>',$lowerBound)
            ->where('birth_date','<',$upperBound)
            ->orderBy('birth_date', 'desc')->paginate($perPage));
    }


    public function getEvents(Request $request){
        $perPage = $request->get('per_page', $this->perPage);

        $lowerBound = date_format(new \DateTime($request->get('start_date', '0001/01/01')),'y-m-d');
        $upperBound = date_format(new \DateTime($request->get('end_date', now())),'y-M-d');


        return new ArticleCollection(Article::where('active', true)
            ->where('published_at', '<', now())
            ->where('event_date','>',$lowerBound)
            ->where('event_date','<',$upperBound)
            ->with('images')
            ->orderBy('published_at', 'desc')
            ->paginate($perPage));

    }
}
