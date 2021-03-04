<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //Fulfilling all existing models in this array_
    private $models = [
        'articles',
        'news',
        'documents',
        'biography',
        'video'
    ];


    public function getCommentsForModel($model, $id, Request $request){
        if(!in_array($model,$this->models)){
            return ['err'=>'Sorry, we dont have such material, try to search for another entity'];
        }

        //$comment = Comment::where('commentable_type','=',"App\Model\{$model}")->where
    }
}
