<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

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
     *  Store a newly created resource in storage and db
     *
     * @param ImageCreateRequest $request
     * @return AdminImageResource|JsonResponse
     */
    public function store(ImageCreateRequest $request)
    {
        $this->authorize('manage', Image::class);

        $data = $request->validated();

        try {

            $image = $this->imageService->storeByType($data['file'], $data['imageable_type']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500,);
        }

        if (!is_null($imageable_id = $data['imageable_id'] ?? null)) {

            if (is_null(
                Image::where('imageable_id', $imageable_id)
                    ->where('imageable_type', $data['imageable_type'])
                    ->first()
            )) {

                $image->imageable_id = $imageable_id;
                $image->save();

            } else {

                return response()->json(['error' => 'Image exists, use update'], 500,);

            }
        }


        return AdminImageResource::make($image);
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return AdminImageResource
     */
    public function show(Image $image)
    {
        $this->authorize('manage', Image::class);

        return new AdminImageResource($image);
    }

    /**
     * Update the specified resource in storage and db
     *
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @return AdminImageResource|JsonResponse
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $this->authorize('manage', Image::class);

        $data = $request->validated();

        try {

            $newImage = $this->imageService->storeByType($data['file'], $image->imageable_type);

            if ($image->imageable_type !== 'common') {
                $model = $image->imageable;
                $image->imageable()->dissociate();
                $newImage->imageable()->associate($model);
                $newImage->save();
            }

            $image->delete();

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500,);
        }

        return new AdminImageResource($newImage);
    }

    /**
     * Remove the specified resource from storage and db
     *
     * @param Image $image
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Image $image)
    {

        $this->authorize('manage', Image::class);

        $image->delete();

        return response(null, 204);
    }

}
