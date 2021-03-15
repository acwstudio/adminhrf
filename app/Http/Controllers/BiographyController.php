<?php

namespace App\Http\Controllers;

use App\Http\Resources\BiographyResource;
use App\Http\Resources\BiographyShortResource;
use App\Models\BioCategory;
use App\Models\Biography;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index(Request $request){
        $perPage = $request->post('per_page', $this->perPage);
        $categoriesArr = $request->post('arr',['none']);

        $lowerBound = ($request->post('cent','0001'));
        $upperBound = (int)($request->post('cent', 21))*100;
        $page= $request->post('page',1);

        $lowerBound = $lowerBound!='0001'?(int)($lowerBound-1)*100:'0001';
        $lowerBound = $lowerBound!='0001'?date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d'):date_format(new \DateTime("01/01/0001"),'Y-m-d');
        $upperBound = date_format(new \DateTime("01/01/{$upperBound}"),'Y-m-d');

        if($categoriesArr[0]=='none'){
            return  BiographyShortResource::collection(Biography::where('active', true)
                        ->where('published_at', '<', now())->where('birth_date','>',$lowerBound)
                        ->where('birth_date','<',$upperBound)
                        ->orderBy('birth_date', 'desc')->paginate($perPage));
        }
//        return BiographyShortResource::collection(BioCategory::firstOrFail()->where('slug','=',$categorySlug)->biographies()
//                        ->where('published_at', '<', now())->with('images')
//                        ->orderBy('published_at', 'desc')->paginate($perPage));
        elseif(count($categoriesArr)<2) {


            return BiographyShortResource::collection(BioCategory::where('slug', (string)$categoriesArr[0])->firstOrFail()->biographies()->where('active', true)
                ->where('published_at', '<', now())->where('birth_date', '>', $lowerBound)
                ->where('birth_date', '<', $upperBound)
                ->orderBy('birth_date', 'desc')->paginate($perPage));
        }
        $arr = [];
        $i = 0;

        foreach ($categoriesArr as $category) {
            if($i++==0){
                $arr = BioCategory::where('slug', $category)->firstOrFail()->biographies()->where('active', true)
                    ->where('published_at', '<', now())->where('birth_date', '>', $lowerBound)
                    ->where('birth_date', '<', $upperBound)->orderBy('birth_date', 'desc')->get()
                    ;
            }
            else{
                $arr = $arr->merge(BioCategory::where('slug', $category)->firstOrFail()->biographies()->where('active', true)
                    ->where('published_at', '<', now())->where('birth_date', '>', $lowerBound)
                    ->where('birth_date', '<', $upperBound)->orderBy('birth_date', 'desc')->get())
                    ;
                $i++;
            }
        }
        $num = count($arr);
        $arr = $arr->sortByDesc('birth_date')->forPage($page,$perPage);


        return ['data' => BiographyShortResource::collection($arr),
                'meta'=> [
                    'last_page' => ceil($num/$perPage),
                    'current_page' => (int)$page,
            ],
        ];
    }

    public function show(Biography $biography){
        return BiographyResource::make($biography);
    }

}
