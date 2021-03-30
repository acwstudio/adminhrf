<?php

namespace App\Http\Controllers;

use App\Models\DayInHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class dayInHistoryController extends Controller
{
    public function index(Request $request){

    }

    public function getDays(Request $request){
        Carbon::today();
        Carbon::yesterday();
        Carbon::tomorrow();

        $data['today'] = DayInHistory::where('month','=',Carbon::today()->month)->where(
            'day','=',Carbon::today()->day)->get();

        $data['tomorrow'] = DayInHistory::where(
            'month','=',Carbon::tomorrow()->month)->where(
            'day','=',Carbon::tomorrow()->day)->get();

        $data['yesterday'] = DayInHistory::where('month','=',Carbon::yesterday()->month)->where('day','=',Carbon::yesterday()->day)->get();

        return $data;
    }
}
