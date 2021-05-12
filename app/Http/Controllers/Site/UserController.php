<?php

namespace App\Http\Controllers\Site;

use App\Actions\Fortify\UpdateUserPassword;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function response;

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

    public function updateProfile(Request $request)
    {
        $data = Validator::make($request->input(), [
            'name' => ['required', 'string', 'max:255'],
            'current_password' => 'required_with:password',
            'password' => 'sometimes|required|string',
            'password_confirmation' => 'required_with:password|same:password',
        ])->validated();

        $user = $request->user();
        $user->name = $data['name'];
        $user->save();

        $response = ['user' => new UserResource($user)];

        if (!is_null($password = $data['password'] ?? null)) {
            (new UpdateUserPassword())->update($user, $data);

            $user->tokens()->delete();
            $response['token'] = $user->createToken('user')->plainTextToken;
        }

        return response()->json($response);

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



}
