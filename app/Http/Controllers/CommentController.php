<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Biography;
use App\Models\Event;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function postCommentNews(Request $req){
        $req = $req->all();
        $news = News::find($req['entity_id']);
        $news->comments()->create([
            'body' => $req['body'],
            'user_id'=> $req['user_id'],
            'parents'=>$req['parents'],
            'is_author' => false, //<- User::is_author($req['user_id'])?true:false, TODO: checking if user is author
            'created_at' => date_timestamp_get(now()),
            'updated_at' => date_timestamp_get(now()),
            ]);
    }

    public function postCommentArticle(Request $req){
        $req = $req->all();
        $article = Article::find($req['entity_id']);
        $article->comments()->create([
            'body' => $req['body'],
            'user_id'=> $req['user_id'],
            'parents'=>$req['parents'],
            'is_author' => false, //<- User::is_author($req['user_id'])?true:false, TODO: checking if user is author
            'created_at' => date_timestamp_get(now()),
            'updated_at' => date_timestamp_get(now()),
            ]);
    }

    public function postCommentBiography(Request $req){
        $req = $req->all();
        $bio = Biography::find($req['entity_id']);
        $bio->comments()->create([
            'body' => $req['body'],
            'user_id'=> $req['user_id'],
            'parents'=>$req['parents'],
            'is_author' => false, //<- User::is_author($req['user_id'])?true:false, TODO: checking if user is author
            'created_at' => date_timestamp_get(now()),
            'updated_at' => date_timestamp_get(now()),
            ]);
    }

    public function postCommentEvent(Request $req){
        $req = $req->all();
        $event = Event::find($req['entity_id']);
        $event->comments()->create([
            'body' => $req['body'],
            'user_id'=> $req['user_id'],
            'parents'=>$req['parents'],
            'is_author' => false, //<- User::is_author($req['user_id'])?true:false, TODO: checking if user is author
            'created_at' => date_timestamp_get(now()),
            'updated_at' => date_timestamp_get(now()),
            ]);
    }

}
