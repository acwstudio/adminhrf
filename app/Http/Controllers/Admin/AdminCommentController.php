<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\Admin\AdminCommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminCommentResource
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        return new AdminCommentResource(Comment::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CommentCreateRequest $request)
    {
        $data = $request->validated();

        $comment = Comment::create($data['data']);

        return (new AdminCommentResource($comment))
            ->response()
            ->header('Location', route('admin.comments.show', [
                'comment' => $comment
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return AdminCommentResource
     */
    public function show(Comment $comment)
    {
        return new AdminCommentResource($comment);
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
        $data = $request->validated();

        $comment->update($data['data']);

        return new AdminCommentResource($comment);
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
