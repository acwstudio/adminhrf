<?php

namespace App\Http\Controllers;

use App\Http\Resources\MagazineResource;
use App\Http\Resources\CategoryResource;
use App\Models\Old\MagazineRelease;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return MagazineResource::collection(MagazineRelease::with('categories', 'categories.article')->latest()->get());
    }

    public function indexMagazines(){
        return MagazineResource::collection(MagazineRelease::all());
    }



    public function show($magazineRelease, Request $request)
    {
        return CategoryResource::collection(MagazineRelease::find($magazineRelease)->categories);
//	return  MagazineRelease::find($magazineRelease)->categories;
    }


}
