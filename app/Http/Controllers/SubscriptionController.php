<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //

    public function getAll(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user=User::findOrFail($request->get('user_id',0));
        $data = [];
        $sub = $user->subscriptions;
        if($sub){
            $num =$sub->count();
            $cnt = 0;
            foreach ($user->bookmarkGroup->bookmarks->sortByDesc('created_at')->forPage($page,$perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if($row){
                    $row->entity = $bookmark->bookmarkable_type;
                    $data[] = $row;
                }
                $cnt++;
            }
            return ['data' => BookmarkShortResource::collection($data),
                'meta'=> [
                    'last_page' => ceil($num/$perPage),
                    'current_page' => (int)$page,
                ],
            ];
        }

        return ['msg'=>'This user doesn\'t have entities in a bookmark list'];

    }
}
