<?php

namespace App\Http\Controllers;

use App\Http\Requests\BiographyCreateRequest;
use App\Http\Requests\BiographyUpdateRequest;
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
     * Store a newly created resource in storage.
     *
     * @param BiographyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BiographyCreateRequest $request)
    {
        $data = $request->validated();

        $biography = Biography::create($data['data']);

        return (new BiographyResource($biography))
            ->response()
            ->header('Location', route('biographies.show', [
                'biography' => $biography
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BiographyUpdateRequest $request
     * @param Biography $biography
     * @return BiographyResource
     */
    public function update(BiographyUpdateRequest $request, Biography $biography)
    {
        $data = $request->validated();

        $biography->update($data['data']);

        return new BiographyResource($biography);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Biography $biography
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Biography $biography)
    {
        $biography->delete();
        return response(null, 204);
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
