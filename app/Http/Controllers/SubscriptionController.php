<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        dd( $request->user());
        //$user = $request->user();
        $user = $request->get('user_id',1);
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        $subscriptions = User::findOrFail($user)->subscriptions;
        $data = [];
        foreach ($subscriptions as $subscription){
            //return $subscription;
            $all = Taggable::where('tag_id','=',$subscription->tag_id)->orderBy('taggable_id','desc')->get();
            foreach ($all as $element){
                //return $element;
                $data[] = $element->taggable;
            }
        }
        return $data;
        //['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }


    public function subscribe(Tag $tag,Request $request){


        $user = $request->user();
        $check = $user->subscriptions()->where('tag_id','=',$tag->id);
        if(!is_null($check)){
            return ['err'=>'Sry, you already have subscription to this tag'];
        }

        $user->subscription()->create([
            'tag_id',
        ]);

        return response('Ok', 200);

    }
}
