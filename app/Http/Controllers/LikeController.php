<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request){

        $model = $request->get('model');
        (int) $id = $request->get('id');

        abort_if(!array_key_exists($model, Relation::$morphMap) || !$id, '404');

        $user = $request->user();



    }

}
