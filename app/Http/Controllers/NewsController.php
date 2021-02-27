<?php

namespace App\Http\Controllers;

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

    private $pagination = 6;

    public function index()
    {
        $articles= News::all();
        return view('news.index', compact('news'));
        # return $articles;
    }

    public function getAnnounceNews($page)
    {
        $news = News::all($this->announceColumns)->forPage($page,$this->pagination)->sortByDesc('created_at');
        $count = News::all()->count()/$this->pagination;
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

    public function getNewsByTag($tagId,$page){
        $tag = Tag::find($tagId);
        $news = $tag->news->forPage($page,$this->pagination)->sortByDesc('created_at');
        $count = $news->count()/$this->pagination;
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

    public function getNews($id)
    {
        $news = News::findOrFail($id,$this->bodyColumns)->toArray();

        /*TODO: GET COMMENTS,LIKES,VIEWS IN THE OTHER QUERY */

        return [
            'news' => $news,
           //'comments' => $news['comments'],
//            'likes' => $likes,
//            'views' => $views,
        ];
    }

}
