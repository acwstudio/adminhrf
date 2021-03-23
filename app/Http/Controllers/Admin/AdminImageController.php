<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        return AdminImageResource::collection(Image::paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImageCreateRequest $request)
    {
        $data = $request->validated();

        $image = Image::create($data['data']);

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
        return new AdminImageResource($image);
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
        $data = $request->validated();

        $image->update($data['data']);

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
