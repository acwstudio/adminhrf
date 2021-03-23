<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //Fulfilling all existing models in this array_
    private $models = [
        'article' => 'article',
        'news' => 'news',
        'document' => 'document',
        'biography' => 'biography',
        'video' => 'video',
        'user' => 'user',
    ];


    /**Not sure but for now gonna store all-in-one controller ( But probbly the best option is to have
     * one controller for One model )
     * @param $model
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|string[]
     */
    public function getCommentsForModel($model, $id, Request $request)
    {
        if (!isset($this->models[$model])) {
            return ['404_err' => 'Sorry, we dont have comments for such material, try to search for another entity'];
        }
        $model = $this->models[$model];
        return $model != 'user' ? CommentResource::collection(
            Comment::get()->where('commentable_type', '=', $this->models[$model])->where('commentable_id', '=', $id)
        ) : CommentResource::collection(User::findOrFail($id)->comments);
    }

    public function getCommentsFromUser($id, Request $request)
    {
        return CommentResource::collection(
            User::findOrFail($id)->comments
        );
    }
}
