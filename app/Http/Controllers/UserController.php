<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
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

    public function getProfile(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function updateProfile(UserUpdateRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();
        $user->name = $data['name'];
        $user->save();

        if (!is_null($password = $data['password'] ?? null)) {
            (new UpdateUserPassword())->update($user, $data);
        }

        return new UserResource($user);

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
        $user = $request->user();

        if ($image = $user->image) {
            $service->delete($image);
        }

        return response(null, 204);

    }

    public function setStatus(Request $request, User $user)
    {
        $this->authorize('manage', User::class);

        $status = $request->post('status');

        if ($user->changeStatus($status)) {
            return response('Status changed', 201);
        }

        return response('Wrong status', 403);

    }


}
