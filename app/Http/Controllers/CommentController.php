<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\CommentCreateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Biography;
use App\Models\Comment;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CommentController extends Controller
{

    protected $sortParams = [
        self::SORT_POPULAR
    ];

    /**
     *
     * Display paginated listing of comments.
     *
     * @param Request $request
     */

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $model_type = $request->get('model_type');
        $id = $request->get('id');

        abort_if(
            !array_key_exists($model_type, Relation::$morphMap) ||
            !$id ||
            !$model = Relation::$morphMap[$model_type]::find($id),
            '404');

        $user = $request->user();

        $comments = Comment::with('user')
            ->where('commentable_type', $model_type)
            ->where('commentable_id', $id)
            ->whereNull('parent_id')
            ->latest()
            ->paginate($perPage);

        return CommentResource::collection($comments);


    }

    public function getUserComments(Request $request)
    {
        $user = $request->user();
        $perPage = $request->get('per_page', 20);
        $sortBy = $request->get('sort_by');

        $query = $user->comments();

        if ($sortBy && in_array($sortBy, $this->sortParams)) {
            $query->orderBy('liked', 'desc');
        }

        $comments = $query->latest()->paginate($perPage);

        return CommentResource::collection($comments);

    }


    public function getAnswers(Request $request, Comment $comment)
    {
        $perPage = $request->get('per_page', 10);

        $comments = $comment->children()->with('user')->orderBy('created_at')->paginate($perPage);

        return CommentResource::collection($comments);
    }



    public function store(CommentCreateRequest $request)
    {
        $data = $request->validated();

        $data['answer_to'] = $data['answer_to'] ?? null;

        if (!is_null($data['parent_id']) && !is_null($data['answer_to'])) {

            if($toUser = User::find(Arr::get($data, 'answer_to.user_id'))) {

                Arr::set($data,'answer_to.user_name', $toUser->name);

            }

        } else {

            $data['answer_to'] = null;

        }

        $data['user_id'] = $request->user()->id;

        return CommentResource::make(Comment::create($data));

    }

    public function destroy(Request $request, Comment $comment)
    {
        abort_if($comment->user()->isNot($request->user()), 403, 'No permissions to delete resource');

        $comment->delete();
    }


}
