<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Like or dislike given model by type and id
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function like(Request $request){

        $model_type = $request->get('model_type');
        $id = $request->get('id');

        abort_if(
            !array_key_exists($model_type, Relation::$morphMap) ||
            !$id ||
            !$model = Relation::$morphMap[$model_type]::find($id),
            '404');

        $user = $request->user();

        $like = Like::where('likeable_type', $model_type)->where('likeable_id', $id)->where('user_id', $user->id)->first();

        if (is_null($like)) {

            Like::create([
                'likeable_type' => $model_type,
                'likeable_id' => $id,
                'user_id' => $user->id
            ]);

            return response('Like', 201);

        } else {

            $like->delete();

            return response('Dislike', 201);

        }


    }

}
