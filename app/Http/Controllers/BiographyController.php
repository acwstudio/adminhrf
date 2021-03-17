<?php

namespace App\Http\Controllers;

use App\Http\Resources\BioCategoryResource;
use App\Http\Resources\BiographyResource;
use App\Http\Resources\BiographyShortResource;
use App\Models\BioCategory;
use App\Models\Biography;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index(Request $request){

        $perPage = $request->get('per_page', $this->perPage);
        $century = $request->get('century', Carbon::now()->century);
        $categories = $request->get('categories');

        $fromDate = Carbon::now()->setYear($century * 100)->startOfCentury();
        $toDate= Carbon::now()->setYear($century * 100)->endOfCentury();

        $query = Biography::where('active', true)
            ->where('published_at', '<', now())
            ->whereBetween('birth_date', [$fromDate, $toDate]);

        if(!is_null($categories)) {
            $params = explode('|', $categories);

            $query->whereHas('categories', function (Builder $query) use ($params) {
                $query->whereIn('slug', $params);
            });
        }

        return BiographyShortResource::collection($query->orderBy('birth_date', 'desc')->paginate($perPage));

    }

    public function show(Biography $biography){
        return BiographyResource::make($biography);
    }


    /**
     * Return biography categories collection
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function categories()
    {
        $categories = BioCategory::withCount('biographies')->orderBy('biographies_count', 'desc')->get();

        return BioCategoryResource::collection($categories);
    }

}
