<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\Admin\AdminNewsCollection;
use App\Http\Resources\Admin\AdminNewsResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AdminNewsCollection
     */
    public function index()
    {
        return new AdminNewsCollection(News::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsCreateRequest $request)
    {
        $data = $request->validated();

        $news = News::create($data['data']);
//        return $news;
        return (new AdminNewsResource($news))
            ->response()
            ->header('Location', route('admin.news.show', [
                'news' => $news
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param News $news
     * @return AdminNewsResource
     */
    public function show(News $news)
    {
        return new AdminNewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsUpdateRequest $request
     * @param News $news
     * @return AdminNewsResource
     */
    public function update(NewsUpdateRequest $request, News $news)
    {
        $data = $request->validated();

        $news->update($data['data']);

        return new AdminNewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        $news->delete();
        return response(null, 204);
    }
}
