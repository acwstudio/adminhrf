<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Http\Resources\TestShortResource;
use App\Models\Biography;
use App\Models\Test;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request){

        $perPage = $request->get('per_page', $this->perPage);
        $categories = $request->get('categories');
        $query = Test::where('is_active','=',true)
            ->where('published_at', '<', now());
        if(!is_null($categories)) {
            $cats = explode('|', $categories);
            $query->whereHas('categories', function(Builder $query) use ($cats) {
                $query->whereIn('slug',$cats);
            });
        }
        return TestShortResource::collection(Test::where('is_active','=',true)->orderBy('published_at')->paginate($perPage));
    }

    public function show($testId,Request $request){
        return TestResource::make(Test::findOrFail($testId)->first()); //TestResource::make();
    }
}
