<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $map = [
        'read' => ['news','article','biography','course'],
        'watch' => ['videomaterial','videocourse'],
        'listen' => ['audiomaterial','podcast'],
        'highlights' => ['highlights']
   ];

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 50); //TODO: change to $this->perPage

        $page = $request->get('page', 1);
        $category = $request->get('category',null);
        $user = $request->user();
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        if(is_null($category)){
            $subscriptions = User::findOrFail($user->id)->subscriptions;
            $data = [];
	    $count = 10;
            foreach ($subscriptions as $subscription){
		//return Carbon::now()->subDays(30);
//		$count = (int)$subscriptions->count;
                $all = Taggable::where('tag_id','=',$subscription->tag_id) //->where('updated_at','>',Carbon::now()->subDays(30))
                    ->orderBy('taggable_id','desc')->paginate($perPage/$count);
                foreach ($all as $element){
                    $data[] = SubscriptionResource::make($element); //$element->taggable;
                }
            }
            return $data;
        }
        elseif(key_exists($category,$this->map)){
            $subscriptions = User::findOrFail($user->id)->subscriptions;
            $data = [];
            $array = $this->map["{$category}"];
            foreach ($subscriptions as $subscription){
		$count = 5;
                $all = Taggable::where('tag_id','=',$subscription->tag_id)
//                    ->where('updated_at','>',Carbon::now()->subDays(30))
                    ->whereIn('taggable_type',$array)->orderBy('taggable_id','desc')->paginate($perPage/$count);
                foreach ($all as $element){
                    $data[] = SubscriptionResource::make($element);
                }
            }
            return $data;
        }


        //['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }


    public function subscribe(Tag $tag,Request $request){
        $user = $request->user();
        $check = $user->subscriptions()->where('tag_id','=',$tag->id)->count();
        if($check>0){
            return ['err'=>'Sry, you already have subscription to this tag'];
        }
        $user->subscriptions()->create([
            'tag_id' => $tag->id,
        ]);

        return response('Ok', 200);
    }

    public function getTags(Request $request){
        $user = $request->user();
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        $data = [];
        foreach ($user->subscriptions as $subscription){
            $data[]=Tag::find($subscription->tag_id);
        }
        return $data;
    }
}
