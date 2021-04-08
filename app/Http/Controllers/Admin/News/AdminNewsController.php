<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsCreateRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\Admin\AdminNewsCollection;
use App\Http\Resources\Admin\AdminNewsResource;
use App\Models\Image;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminNewsController
 * @package App\Http\Controllers\Admin\News
 */
class AdminNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AdminNewsCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(News::class)
            ->allowedIncludes(['tags', 'images', 'bookmarks', 'comments'])
            ->allowedSorts(['id', 'title', 'published_at'])
            ->allowedFilters(['status', 'show_in_main', 'show_in_afisha'])
            ->jsonPaginate($perPage);

        return new AdminNewsCollection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');

        $news = News::create($data);

        // update field imageable_id of images table with new $article->id
        foreach ($dataRelImages as $imageId) {
            $image = Image::find($imageId);
            if ($image) {
                Image::findOrFail($imageId)->update([
                    'imageable_id' => $news->id
                ]);
            }
        }

        // attach tags for the news
        $news->tags()->attach($dataRelTags);

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
        $query = QueryBuilder::for(News::class)
            ->where('id', $news->id)
            ->allowedIncludes('tags', 'images', 'bookmarks', 'comments')
            ->firstOrFail();

        return new AdminNewsResource($query);
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
        $data = $request->input('data.attributes');
        $dataRelImages = $request->input('data.relationships.images.data.*.id');
        $dataRelTags = $request->input('data.relationships.tags.data.*.id');

        $news->update($data);

        foreach ($dataRelImages as $imageId) {
            $image = Image::find($imageId);
            if ($image) {
                Image::findOrFail($imageId)->update([
                    'imageable_id' => $news->id
                ]);
            }
        }

        $news->tags()->sync($dataRelTags);

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
