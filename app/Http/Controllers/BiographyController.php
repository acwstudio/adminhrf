<?php

namespace App\Http\Controllers;

use App\Http\Resources\BiographyShortResource;
use App\Models\BioCategory;
use App\Models\Biography;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index(Request $request){
        $perPage = $request->get('per_page', null);
        $categorySlug = (string)$request->get('category', 'none');
        $lowerBound = $request->get('lower_bound',1);
        $upperBound = $request->get('upper_bound', now());

        $lowerBound = date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d');
        $upperBound = date_format(new \DateTime("01/01/{$upperBound}"),'Y-m-d');

        if($categorySlug=='none'){
            return  BiographyShortResource::collection(Biography::where('active', true)
                        ->where('published_at', '<', now())->where('birth_date','>',$lowerBound)
                        ->where('birth_date','<',$upperBound)->with('images')
                        ->orderBy('birth_date', 'desc')->paginate($perPage));
        }

//        return BiographyShortResource::collection(BioCategory::firstOrFail()->where('slug','=',$categorySlug)->biographies()
//                        ->where('published_at', '<', now())->with('images')
//                        ->orderBy('published_at', 'desc')->paginate($perPage));
        return BioCategory::where('slug',$categorySlug)->firstOrFail()->biographies()->where('active', true)
                                           ->where('published_at', '<', now())->where('birth_date','>',$lowerBound)
                                           ->where('birth_date','<',$upperBound)->with('images')
                                           ->orderBy('birth_date', 'desc')->paginate($perPage);
    }
}
