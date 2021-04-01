<?php

namespace App\Http\Controllers;

use App\Http\Resources\DayInHistoryResource;
use App\Models\DayInHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class dayInHistoryController extends Controller
{
    public function index(Request $request){

    }

    public function getDays(Request $request){


        return [
            'today' => DayInHistoryResource::make(
                DayInHistory::where('month', Carbon::today()->month)->where('day', Carbon::today()->day)->first()
            ),

            'tomorrow' => DayInHistoryResource::make(
                DayInHistory::where('month', Carbon::tomorrow()->month)->where('day', Carbon::tomorrow()->day)->first()
            ),
            'yesterday' => DayInHistoryResource::make(
                DayInHistory::where('month', Carbon::yesterday()->month)->where('day', Carbon::yesterday()->day)->first()
            )
        ];
    }
}
