<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentCreateRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminCommentController
 * @package App\Http\Controllers\Admin\Comment
 */
class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminCommentCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Comment::class)
            ->with('user')
            ->allowedIncludes('user')
            ->jsonPaginate();

        return new AdminCommentCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentCreateRequest $request)
    {
//        $data = $request->validated();
//
//        $comment = Comment::create($data['data']);
//
//        return (new AdminCommentResource($comment))
//            ->response()
//            ->header('Location', route('admin.comments.show', [
//                'comment' => $comment
//            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminCommentResource
     */
    public function show(Comment $comment)
    {
        $query = QueryBuilder::for(Comment::where('id', $comment->id))
            ->allowedIncludes('user')
            ->firstOrFail();

        return new AdminCommentResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminCommentResource
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
//        $data = $request->validated();
//
//        $comment->update($data['data']);
//
//        return new AdminCommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response(null, 204);
    }
}
