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
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $category = $request->get('category');

        $user = $request->user();
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        if(!$category){
            $subscriptions = User::findOrFail($user)->subscriptions;
            $data = [];
            foreach ($subscriptions as $subscription){
                $all = Taggable::where('tag_id','=',$subscription->tag_id)->where('updated_at','>',Carbon::now()->subDays(30))
                    ->orderBy('taggable_id','desc')->paginate();
                foreach ($all as $element){
                    $data[] = $element->taggable;
                }
            }
            return $data;
        }
        elseif(key_exists($category,$this->map)){
            $subscriptions = User::findOrFail($user)->subscriptions;
            $data = [];
            $array = $this->map["{$category}"];
            foreach ($subscriptions as $subscription){
                $all = Taggable::where('tag_id','=',$subscription->tag_id)
                    ->where('updated_at','>',Carbon::now()->subDays(30))
                    ->whereHas('categories', function (Builder $query) use ($array) {
                        $query->whereIn('taggable_type', $array);
                    })->orderBy('taggable_id','desc')->paginate();
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

        $check = $user->subscriptions()->where('tag_id','=',$tag->id);
        if(is_null($check)){
            return ['err'=>'Sry, you already have subscription to this tag'];
        }
        Subscription::create([
            'tag_id' => $tag->id,
            'user_id' => $user->id,
        ]);

        return response('Ok', 200);
    }
}
