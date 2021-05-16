<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\CategoryResource;
use App\Http\Resources\Site\MagazineArticleResource;
use App\Http\Resources\Site\MagazineResource;
use App\Models\Old\MagazineRelease;
use App\Models\Old\MagazineReleaseArticle;
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

    public function indexMagazines()
    {
        return MagazineResource::collection(MagazineRelease::all());
    }


    public function show($magazineRelease, Request $request)
    {
        return CategoryResource::collection(MagazineRelease::find($magazineRelease)->categories);
//	return  MagazineRelease::find($magazineRelease)->categories;
    }

    public function showArticle($magazineArticle, Request $request)
    {
        return MagazineArticleResource::make(MagazineReleaseArticle::find($magazineArticle));
//	return  MagazineRelease::find($magazineRelease)->categories;
    }


}
