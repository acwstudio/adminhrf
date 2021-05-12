<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Resources\HighlightShortResource;
use App\Models\Highlight;
use Illuminate\Http\Request;

class TempThemeOfTheWeekController extends Controller
{
    public function index(Request $request)
    {
        return HighlightShortResource::make(Highlight::where('order', '=', 1)->where('type', '=', 'highlight')->where('active', true)->firstOrFail());
    }
}
