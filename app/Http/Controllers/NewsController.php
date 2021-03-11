<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleShortResource;
use App\Http\Resources\BookmarkShortResource;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsShortResource;
use App\Models\Article;
use App\Models\Bookmark;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use OpenApi\Tests\Fixtures\NestedProperty;

class NewsController extends Controller
{
    protected $announceColumns = [
        'id',
        'title',
        'slug',
        'viewed',
        'announce',
        'listorder',
        'status',
        'published_at',
        'slug',
    ];

    protected $bodyColumns = [
        'title',
        'slug',
        'body',
        'viewed',
        'show_in_main',
        'close_commentation',
        'published_at',
    ];

    public function index()
    {
        $articles= News::all();
        return view('news.index', compact('news'));
        # return $articles;
    }

    public function getAnnounceNews(Request $request)
    {
//        if ($token = $request->bearerToken()) {
//            $model = Sanctum::$personalAccessTokenModel;
//
//            $accessToken = $model::findToken($token);
//        }
//        $user_id = $accessToken?$accessToken:null;
        $perPage = $request->get('per_page', $this->perPage);
        return NewsShortResource::collection(News::where('status', true)->where('published_at','<',now())->orderBy('published_at','desc')->paginate($perPage));
//        return auth('api')->user();
//        foreach ($data as $element){
//            $element['is_liked'] = is_null($element->likes()->where('user_id','=',$request->get('user_id',0)));
//        }
        #$data['data']['is_liked'] = $news->likes()->where('user_id','=',$request->get('user_id',0));
        //return $data;
    }

    public function getNews(News $news)
    {

        /*TODO: GET COMMENTS,LIKES,VIEWS IN THE OTHER QUERY */
        #return News::findOrFail($id)->likes();
        return NewsResource::make($news);
        #return News::findOrFail($id)->countLikes()
    }

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
