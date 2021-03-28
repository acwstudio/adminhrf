<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminImageController
 * @package App\Http\Controllers\Admin\Image
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
//            ->allowedIncludes('articles')
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
//        it's not real code, it's only for testing by Postman
        $file = $request->file('image');
        $filename = 'test-image-' . $request->input('imageable_type') . time() . $file
                ->getClientOriginalExtension();
        $path = $file->store('public/sump');

        $image = Image::create([
            'imageable_type' => $request->input('imageable_type')
        ]);

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
        $file = $request->file('image');

//      it's not reall code, it's only for testing by Postman
        $filename = $image->name;

        $path = $file->store('public/sump');

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

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function loadImage(Request $request, UploadedFile $uploadedFile)
    {
//        It's not real code, it's only test for Postman
//        $this->validate($request, [
//            'image' => 'required'
//        ]);

        $image = $request->file('image');

        return $uploadedFile;
    }
}
