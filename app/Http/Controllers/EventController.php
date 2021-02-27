<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $announceColumns = [
        'id',
        'start_date',
        'end_date',
        'title',
        'slug',
        'graph_announce',
        'card_announce',
        'date_year',
        'date_month',
        'date_day',
        'show_in_timeline',
        'is_date_bc'
    ];

    private $eventColumns = [
        'id',
        'start_date',
        'end_date',
        'title',
        'slug',
        'graph_announce',
        'card_announce',
        'description',
        'date_year',
        'date_month',
        'date_day',
        'is_date_bc',
        'close_commentation',
    ];
    //



    public function getEventsForCentury($century){
        $lowerBound = ($century-1)*100;
        $upperBound = ($century-1)*100+99;
        $event = Event::all($this->announceColumns)->where('show_in_timeline','=', true)
            ->where('is_date_bc','=',false)
            ->whereBetween('start_date',[date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d'),date_format(new \DateTime("12/31/{$upperBound}"),'Y-m-d')])
            ->sortBy('date_year',1,'ASC')
            ->toArray();
        return count($event)>0?$event:['err'=>'There are no events in this century','da'=>date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d'),'date_ev'=>Event::find(22)];
    }

    public function getEventsForDecade($lowerBound){
        $upperBound = $lowerBound+10;
        $event = Event::all($this->announceColumns)->where('show_in_timeline','=', true)
            ->where('is_date_bc','=',false)
            ->whereBetween('start_date',[date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d'),date_format(new \DateTime("12/31/{$upperBound}"),'Y-m-d')])
            ->sortBy('date_year',1,'ASC')
            ->toArray();
        return count($event)>0?$event:['err'=>'There are no events in this century','da'=>date_format(new \DateTime("01/01/{$lowerBound}"),'Y-m-d'),'date_ev'=>Event::find(22)];
    }

    public function getEventById($id){
        $event = Event::findOrFail($id,$this->eventColumns);

        return [
            'event' => $event,
            //'comments' => $event['close_commentation']?null:$comments,
//            'likes' => $likes,
//            'views' => $views,
        ];
    }
}
