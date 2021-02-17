<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected $announceColumns = [
        'id','announce', 'author_id', 'title','image_id','url','date','created_at'
    ];

    protected $articleColumns = [

    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $articles= Article::all();
       return view('articles.index', compact('articles'));
       # return $articles;
    }

    public function getArticlesByTag($tagId){
        $tags = Tag::find($tagId);
/* TODO:        $author;
        //count(likes)
         //   count(comments) */
        #$articles = Article::all()->tags($tagId);

        return $tags->articles;
    }

    public function getArticlesByAuthor($authorId){
        $articles = Article::all()->where('author_id','=',$authorId);
        return json_encode($articles);
    }

    public function getAnnounceList()
    {
        $articles = Article::all($this->announceColumns);
        return $articles;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('articles.create');//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'title'=>'required|unique:articles|max:255',
            'slug'=>'required|unique:articles|max:100',
            'url'=>'required|unique:articles|max:100',
            'announce'=>'required',
            'listorder'=>'max:100000',
            'body'=>'required',
            'show_in_rss'=>'required',
            'status'=>'required',
            'image_id'=>'required',
            'show_in_main'=>'required',
            'close_commentation'=>'required',
            'seo_title',
            'seo_keyword',
            'seo_description'
        ]);
        /*
         $validator = Validator::make($request->all(),[
            'title'=>'required|unique:articles|max:255',
            'slug'=>'required|unique:articles|max:100',
            'url'=>'required|unique:articles|max:100',
            'announce'=>'required',
            'listorder'=>'max:100000',
            'body'=>'required',
            'show_in_rss'=>'required',
            'status'=>'required',
            'image_id'=>'required',
            'show_in_main'=>'required',
            'close_commentation'=>'required'
        ]);
        if($validator->fails())
        {
            return redirect('/api/articles')->withErrors($validator)->withInput();
        }
         */

        $article = new Article(
            [
                'title'=>$request->get('title'),
                'slug'=>$request->get('slug'),
                'url'=>$request->get('url'),
                'announce'=>$request->get('announce'),
                'listorder'=>$request->get('listorder'),
                'body'=>$request->get('body'),
                'seo_title'=>$request->get('seo_title'),
                'seo_description'=>$request->get('seo_description'),
                'seo_keywords'=>$request->get('seo_keywords'),
                'show_in_rss'=>$request->get('show_in_rss')==1?true:false,
                'yatextid'=>$request->get('yatextid'),
                'status'=>$request->get('status')==1?true:false,
                'image_id'=>$request->get('image_id')==1?true:false,
                'announce_imade_id'=>func($request->get('image_id')==1?true:false),
                'show_in_main'=>$request->get('show_in_main'),
                'close_commentation'=>$request->get('close_commentation')==1?true:false,
                'gallery_id'=>$request->get('gallery_id'),
            ]
        );

        $article->save();
        #$article->cre
        return redirect('/articles')->with('success','model added!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|unique:articles|max:255',
            'slug'=>'required|unique:articles|max:100',
            'url'=>'required|unique:articles|max:100',
            'announce'=>'required',
            'listorder'=>'max:100000',
            'body'=>'required',
            'show_in_rss'=>'required',
            'status'=>'required',
            'image_id'=>'required',
            'show_in_main'=>'required',
            'close_commentation'=>'required',
            'seo_title',
            'seo_keyword',
            'seo_description'
        ]);

        $article = Article::find($id);
        $article->title=$request->get('title');
        $article->slug=$request->get('slug');
        $article->url=$request->get('url');
        $article->announce=$request->get('announce');
        $article->listorder=$request->get('listorder');
        $article->body=$request->get('body');
        $article->seo_title=$request->get('seo_title');
        $article->seo_description=$request->get('seo_description');
        $article->seo_keywords=$request->get('seo_keywords');
        $article->show_in_rss=$request->get('show_in_rss');
        $article->yatext_id=$request->get('yatextid');
        $article->status=$request->get('status');
        $article->image_id=$request->get('image_id');
        $article->show_in_main=$request->get('show_in_main');
        $article->close_commentation=$request->get('close_commentation');
        $article->gallery_id=$request->get('gallery_id');
        $article->save();

        /*
        $article->first_name =  $request->get('first_name');
        $article->last_name = $request->get('last_name');
        $article->email = $request->get('email');
        $article->job_title = $request->get('job_title');
        $article->city = $request->get('city');
        $article->country = $request->get('country');
         */
        return redirect('/articles')->with('success', 'article updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return redirect('/articles')->with('success', 'article deleted!');
    }
}
