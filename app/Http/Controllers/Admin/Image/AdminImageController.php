<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class AdminImageController
 * @package App\Http\Controllers\Admin\Image
 */
class AdminImageController extends Controller
{
    public $imageService;

    /**
     * AdminImageController constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $query = QueryBuilder::for(Image::class)
//            ->with('articles')
//            ->allowedIncludes('articles')
            ->jsonPaginate($perPage);

        return AdminImageResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImageCreateRequest $request)
    {

        $file = $request->file('file');

        $image = $this->imageService->storeByType($file, $request->imageable_type);

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
        $query = QueryBuilder::for(Image::class)
            ->where('id', $image->id)
            ->firstOrFail();

//        return $query->imageable;
        return new AdminImageResource($query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return AdminImageResource
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $file = $request->file('image');

        $image = $this->imageService->storeByType($file, $request->imageable_type);

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
        $this->imageService->delete($image);

        $image->delete();

        return response(null, 204);
    }

}
