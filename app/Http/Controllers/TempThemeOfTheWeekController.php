<?php

namespace App\Http\Controllers;

use App\Http\Resources\HighlightShortResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

class TempThemeOfTheWeekController extends Controller
{
    public function index(Request $request){
        return HighlightShortResource::make(Highlight::where('order','=',1)->firstOrFail());
    }
}
