<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsShortResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
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
        return NewsShortResource::collection(News::where('status', true)->where('published_at','<',now())->orderBy('published_at','desc')->paginate($perPage));
//        foreach ($data as $element){
//            $element['is_liked'] = is_null($element->likes()->where('user_id','=',$request->get('user_id',0)));
//        }
        #$data['data']['is_liked'] = $news->likes()->where('user_id','=',$request->get('user_id',0));
        //return $data;
    }

    public function getNews($id)
    {

        /*TODO: GET COMMENTS,LIKES,VIEWS IN THE OTHER QUERY */
        #return News::findOrFail($id)->likes();
        return NewsResource::make(News::findOrFail($id));
        #return News::findOrFail($id)->countLikes()
    }


}
