<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookmarkShortResource;
use App\Models\User;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function getBookmarks(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user=User::findOrFail($request->get('user_id',0));
        $data = [];
        $num =$user->bookmarkGroup->bookmarks->count();
        foreach ($user->bookmarkGroup->bookmarks->sortByDesc('created_at')->forPage($page,$perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
            $row = $bookmark->bookmarkable;
            $row->entity = $bookmark->bookmarkable_type;
            $data[] = $row;
        }

        #$data = array_slice($data,$page*$perPage, $perPage);

        # $val=count($val)

        return ['data' => BookmarkShortResource::collection($data),
            'meta'=> [
                'last_page' => ceil($num/$perPage),
                'current_page' => (int)$page,
            ],
        ];
//        return $user->bookmarks;
    }
}
