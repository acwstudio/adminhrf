<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use Carbon\Carbon;
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
            foreach ($subscriptions as $subscription){
		//return Carbon::now()->subDays(30);
                $all = Taggable::where('tag_id','=',$subscription->tag_id) //->where('updated_at','>',Carbon::now()->subDays(30))
                    ->orderBy('taggable_id','desc')->paginate(50);
                foreach ($all as $element){
			$data[] = $element->taggable;
                }
            }
            return $data;
        }
        elseif(key_exists($category,$this->map)){
            $subscriptions = User::findOrFail($user->id)->subscriptions;
            $data = [];
            $array = $this->map["{$category}"];
            foreach ($subscriptions as $subscription){
                $all = Taggable::where('tag_id','=',$subscription->tag_id)
//                    ->where('updated_at','>',Carbon::now()->subDays(30))
                    ->whereIn('taggable_type',$array)->orderBy('taggable_id','desc')->paginate();
                foreach ($all as $element){
                    $data[] = $element->taggable;
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
}
