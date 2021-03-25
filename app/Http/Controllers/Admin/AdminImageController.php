<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminImageController
 * @package App\Http\Controllers\Admin
 */
class AdminImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $query = QueryBuilder::for(Image::class)
            ->with('articles')
            ->allowedIncludes('articles')
            ->jsonPaginate();

        return AdminImageResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImageCreateRequest $request)
    {
        $data = $request->input('data.attributes');

        $image = Image::create($data);

        return (new AdminImageResource($image))
            ->response()
            ->header('Location', route('admin.images.show', [
                'image' => $image
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return AdminImageResource
     */
    public function show(Image $image)
    {
        $query = QueryBuilder::for(Image::where('id', $image->id))
            ->firstOrFail();

        return new AdminImageResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return AdminImageResource
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $data = $request->input('data.attributes');

        $image->update($data);

        return new AdminImageResource($image);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return response(null, 204);
    }
}
