<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookmarkShortResource;
use App\Models\User;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    private $models = [
      'read' => [
          'news', 'documents','article','biography'
      ],
      'watch' => [
          'video'
      ],
      'listen' => [
          'audio'
      ]
    ];


    public function getBookmarks(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user = User::findOrFail($request->get('user_id',0));
        $data = [];
        $groups = $user->bookmarkGroup;
        if($groups){
            $num =$groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page,$perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if($row){
                    $row->entity = $bookmark->bookmarkable_type;
                    $data[] = $row;
                }
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


    public function getBookmarksActions(string $action,Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user=User::findOrFail($request->get('user_id',0));
        $data = [];
        $groups = $user->bookmarkGroup;
        if($groups){
            $num =$groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page,$perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if($row){

                    if(in_array($bookmark->bookmarkable_type,$this->models["{$action}"])) {
                        $row->entity = $bookmark->bookmarkable_type;
                        $data[] = $row;
                    }
                }
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

    public function getBookmarksListen(Request $request){
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user=User::findOrFail($request->get('user_id',0));
        $data = [];
        $groups = $user->bookmarkGroup;
        if($groups){
            $num =$groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page,$perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if($row){
                    if($bookmark->bookmarkable_type=='news'||$bookmark->bookmarkable_type=='article'||
                        $bookmark->bookmarkable_type=='document'||$bookmark->bookmarkable_type=='biography') {
                        $row->entity = $bookmark->bookmarkable_type;
                        $data[] = $row;
                    }
                }
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
