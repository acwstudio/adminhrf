<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilmsResource;
use App\Http\Resources\FilmsShortResource;
use App\Models\Videomaterial;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    protected $sortParams = [
        self::SORT_POPULAR
    ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 16);
        $sortBy = $request->get('sort_by');
        $query = Videomaterial::where('published_at', '<', now())
                              ->where('type', '=', 'film')
                              ->where('active', '=', true)
                              ->with('images');
        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }
        return FilmsShortResource::collection(
                $query
                ->orderBy('published_at', 'desc')
                ->paginate($perPage));
        //Film::
    }


    public function show(Videomaterial $videomaterial, Request $request)
    {
        return $videomaterial->type=='film'?FilmsResource::make($videomaterial):['err'=>'Idk anout such entity here'];
    }
}
