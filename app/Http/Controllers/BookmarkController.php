<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookmarkShortResource;
use App\Models\Bookmark;
use App\Models\BookmarkGroup;
use App\Models\User;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    private $models = [
        'read' => [
            'news', 'documents', 'article', 'biography', 'course'
        ],
        'watch' => [
            'videomaterial', 'videocourse'
        ],
        'listen' => [
            'audiomaterial', 'audiocourse'
        ],
        'events' => [
            'event'
        ],
        'highlights' => [
            'highlight'
        ]

    ];


    public function setBookmark(Request $request)
    {
        $bookmarkableType = $request->get('model_type');
        $bookmarkableId = (int)$request->get('id');
//        $userId = (int)$request->get('user_id');
//      $user= User::find($userId)->first();

        $user = $request->user();

        if (!$user) {
            return ['err' => 'You are not authorized or there are no such user'];
        }
        $bookmarkGroup = $user->bookmarkGroup()->first();
        if (is_null($bookmarkGroup)&&!is_null($bookmarkableId)) {
            $bookmarkGroup = BookmarkGroup::create(
                [
                    'title' => 'default',
                    'user_id' => $user->id,
                ]
            );
            Bookmark::create([
                'bookmarkable_type' => $bookmarkableType,
                'bookmarkable_id' => $bookmarkableId,
                'group_id' => $bookmarkGroup->id
            ]);
        }
        elseif(!is_null($bookmarkableId)) {
            $bookmark = $bookmarkGroup->bookmarks->where('bookmarkable_type','=',$bookmarkableType)
                                    ->where('bookmarkable_id', '=', $bookmarkableId)->first();
            if(!$bookmark) {
                Bookmark::create([
                    'bookmarkable_type' => $bookmarkableType,
                    'bookmarkable_id' => $bookmarkableId,
                    'group_id' => $bookmarkGroup->id
                ]);
            }
            else{
                $bookmark->delete();
            }

        }
        return response('Ok', 200);
    }



    public function getBookmarks(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        //$user = User::findOrFail($request->get('user_id', 0));id
        $user = $request->user();
        if(!$user){
            return ['err' => 'You are not authorized'];
        }
        $data = [];
        $groups = $user->bookmarkGroup;
        if ($groups) {
            $num = $groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page, $perPage) as $bookmark) {
                $row = $bookmark->bookmarkable;
                if ($row) {
                    $row->entity = $bookmark->bookmarkable_type;
                    $row->has_like = $user&&$row->entity!='news'?$row->checkLiked($user):false;
                    $row->has_bookmark = $user?$row->checkBookmark($user):false;
                    $data[] = $row;
                }
            }
            return ['data' => BookmarkShortResource::collection($data),
                'meta' => [
                    'last_page' => ceil($num / $perPage),
                    'current_page' => (int)$page,
                ],
            ];
        }

        return ['msg' => 'This user doesn\'t have entities in a bookmark list'];

    }


    public function getBookmarksActions(string $action, Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        //$user = User::findOrFail($request->get('user_id', 0));
        $user = $request->user();
        $data = [];
        if(!$user){
          return ['err' => 'You are not authorized'];
        }
        $groups = $user->bookmarkGroup;
        if ($groups) {
            $num = $groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page, $perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if ($row) {
                    if (in_array($bookmark->bookmarkable_type, $this->models["{$action}"])) {
                        $row->entity = $bookmark->bookmarkable_type;
                        $data[] = $row;
                    }
                }
            }
            return ['data' => BookmarkShortResource::collection($data),
                    'meta' => [
                    'last_page' => ceil($num / $perPage),
                    'current_page' => (int)$page,
                ],
            ];
        }

        return ['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }

    public function getBookmarksListen(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $page = $request->get('page', 1);
        $user = User::findOrFail($request->get('user_id', 0));
        $data = [];
        $groups = $user->bookmarkGroup;
        if ($groups) {
            $num = $groups->bookmarks->count();
            foreach ($groups->bookmarks->sortByDesc('created_at')->forPage($page, $perPage) as $bookmark) { //->skip($page*$perPage)->take($perPage)
                $row = $bookmark->bookmarkable;
                if ($row) {
                    if ($bookmark->bookmarkable_type == 'news' || $bookmark->bookmarkable_type == 'article' ||
                        $bookmark->bookmarkable_type == 'document' || $bookmark->bookmarkable_type == 'biography') {
                        $row->entity = $bookmark->bookmarkable_type;
                        $data[] = $row;
                    }
                }
            }
            return ['data' => BookmarkShortResource::collection($data),
                'meta' => [
                    'last_page' => ceil($num / $perPage),
                    'current_page' => (int)$page,
                ],
            ];
        }

        return ['msg' => 'This user doesn\'t have entities in a bookmark list'];
    }
}
