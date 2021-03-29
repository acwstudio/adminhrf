<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);

        //$user = $request->user();
        $user = $request->get('user_id',1);
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        $subscriptions = User::findOrFail($user)->subscriptions();
        $data = [];
        $i = 0;
        foreach($subscriptions as $subscription){
            if($i=0){
                $data =$subscription->tag->news();
            }
            else{
                $data->merge($subscription->tag->news());
            }
            $data = $data->merge($subscription->tag->article());
            $data = $data->merge($subscription->tag->highlights());
            $data = $data->merge($subscription->tag->videomaterials());
            $data = $data->merge($subscription->tag->audiomaterials());
            $i++;
        }

        return User::findOrFail($user)->first()->subscriptions->first->tag();//['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }


    public function subscribe(Tag $tag){

    }
}
