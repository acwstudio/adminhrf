<?php

namespace App\Http\Controllers\Admin\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentCreateRequest;
use App\Http\Requests\Comment\CommentUpdateRequest;
use App\Http\Resources\Admin\AdminCommentCollection;
use App\Http\Resources\Admin\AdminCommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
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
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $query = QueryBuilder::for(Comment::class)
            ->allowedIncludes('user')
            ->allowedSorts(['id', 'created_at'])
            ->allowedFilters(['type', 'status'])
            ->jsonPaginate($perPage);

        return new AdminCommentCollection($query);
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
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
     * @param CommentUpdateRequest $request
     * @param Comment $comment
     * @return AdminCommentResource
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $dataAttributes = $request->input('data.attributes');
        $data = Arr::only($dataAttributes, ['text', 'status']);

        $comment->update($data);

        return new AdminCommentResource($comment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response(null, 204);
    }
}
