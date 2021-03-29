<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function getAll(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);

        $user = $request->user();
        if(!$user){
            return ['err' => 'Not authorized'];
        }
        $sub = $user->subscriptions;
        if ($sub) {

        }

        return ['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }


    public function subscribe(Tag $tag){

    }
}
