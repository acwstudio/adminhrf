<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Http\Resources\Admin\AdminImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param ImageCreateRequest $request
     * @param ImageService $service
     * @return AdminImageResource|JsonResponse
     */
    public function store(ImageCreateRequest $request, ImageService $service)
    {
        $data = $request->validated();

        try {

            $image = $service->storeByType($data['file'], $data['imageable_type']);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500,);
        }

        if (!is_null($imageable_id = $data['imageable_id'] ?? null)) {

            if (is_null(
                Image::where('imagable_id', $imageable_id)
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
        return new AdminImageResource($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageUpdateRequest $request
     * @param Image $image
     * @param ImageService $service
     * @return JsonResponse|AdminImageResource
     */
    public function update(ImageUpdateRequest $request, Image $image, ImageService $service)
    {
        $data = $request->validated();

        try {

            $newImage = $service->storeByType($data['file'], $data['imageable_type']);

            if ($data['imageable_type'] !== 'common') {
                $model = $image->imageable;
                $image->imageable()->dissociate();
                $newImage->imageable()->associate($model);
            }

            $service->delete($image);


        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500,);
        }


        return new AdminImageResource($newImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @param ImageService $service
     * @return Response
     * @throws \Exception
     */
    public function destroy(Image $image, ImageService $service)
    {
        if ($image->imageable_type !== 'common') {

            $image->imageable()->dissociate();

        }

        $service->delete($image);

        return response(null, 204);
    }
}
