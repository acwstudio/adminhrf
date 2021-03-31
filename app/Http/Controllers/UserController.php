<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     *
     * Return logged in user
     *
     * @param Request $request
     * @return UserResource
     */

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function avatarStore(Request $request, ImageService $service)
    {
        $data = $request->validate([
            'file' => 'required|image',
        ]);

        $user = $request->user();

        try {

            $newImage = $service->storeByType($data['file'], 'user');

            if ($image = $user->image) {

                $image->imageable()->dissociate();
                $service->delete($image);

            }

            $newImage->imageable()->associate($user);
            $newImage->save();


        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500,);
        }

        return ImageResource::make($newImage);

    }

    public function avatarDelete(Request $request, ImageService $service)
    {
        $user =  $request->user();

        if ($image = $user->image) {
            $service->delete($image);
        }

        return response(null, 204);

    }


}
