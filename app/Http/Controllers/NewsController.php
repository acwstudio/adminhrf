<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $announceColumns = [
        'id',
        'title',
        'slug',
        'announce',
        'listorder',
        'status',
        'created_at',
        'slug',
    ];

    protected $bodyColumns = [
        'title',
        'slug',
        'body',
        'show_in_main',
        'close_commentation',
        'created_at',
    ];

    public static $pagination = 6;

    public function index()
    {
        $articles= News::all();
        return view('news.index', compact('news'));
        # return $articles;
    }

    public function getAnnounceNews(Request $request)
    {
        $perPage = $request->get('per_page', $this->perPage);
        $news = News::where('status', true)->orderBy('created_at','desc')->paginate($perPage);
        return NewsResource::collection($news);
//        $count = News::all()->count()/NewsController::$pagination;
//        $arr = [];
//        //TEST
//        foreach ($news as $it) {
//            $arr[]=$it;
//            //TODO: Count of likes, comments and views
//            //$it['comments'] = count($it->comments->toArray());
//            //$it['likes'] = count($it->likes->toArray());
//        }
//
//        //$news = new NewsCollection($news);
//        $obj['pages']=ceil($count);
//       // $obj['cur_page']=(int)$page;
//        return [
//            'data' => $news->toArray(),
//            'pages' => ceil($count),
//            'cur_page' => (int)0
//        ];
    }

    public function getNews($id)
    {
        return News::findOrFail($id)->toArray();
        /*TODO: GET COMMENTS,LIKES,VIEWS IN THE OTHER QUERY */


    }

    public function getNewsByTag($tagId,$page){
        $tag = Tag::find($tagId);
        $news = $tag->news->forPage($page,NewsController::$pagination)->sortByDesc('created_at');
        $count = $news->count()/NewsController::$pagination;
        $arr = [];
        //TEST
        foreach ($news as $it) {
            $arr[]=$it;
            //TODO: Count of likes, comments and views
            //$it['comments'] = count($it->comments->toArray());
            //$it['likes'] = count($it->likes->toArray());
        }
        $obj['news']=$arr;
        $obj['pages']=ceil($count);
        $obj['cur_page']=(int)$page;

        return $obj;
    }

}
