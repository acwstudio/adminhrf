<?php

namespace App\Http\Controllers;

use App\Http\Resources\MagazineResource;
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



    public function show()
    {
        //
    }



}
