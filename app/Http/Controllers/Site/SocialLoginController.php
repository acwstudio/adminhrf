<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\SocialUser;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use function redirect;

class SocialLoginController extends Controller
{
    /**
     *
     * @var StatefulGuard
     */
    protected $guard;


    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    public function callback($service, Request $request, ImageService $imageService)
    {

        $oauthUser = Socialite::driver($service)->stateless()->user();


        $socialUser = SocialUser::where('external_id', $oauthUser->id)
            ->where('service', $service)
            ->first();

        if (is_null($socialUser)) {

            $user = $this->checkUser($oauthUser);

            $socialUser = new SocialUser();

            $socialUser->external_id = $oauthUser->id;
            $socialUser->service = $service;
            $socialUser->external_user = $oauthUser->user;
            $socialUser->user()->associate($user);

            $socialUser->save();

        }

        if (!$socialUser->user->image && $oauthUser->avatar) {
            try {

                $newImage = $imageService->storeByType($oauthUser->avatar, 'user');

                $newImage->imageable()->associate($socialUser->user);
                $newImage->save();


            } catch (\Exception $exception) {

            }
        }

        $token = $socialUser->user->createToken($service, ['user:social']);

        return redirect(config('app.client_url') . "?type=social_login&token={$token->plainTextToken}");
    }


    protected function checkUser($oauthUser): User
    {
        $user = null;
        if (!is_null($oauthUser->email)) {
            $user = User::firstWhere('email', $oauthUser->email);
        }

        if (is_null($user)) {
            $user = User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email
            ]);
        }

        return $user;

    }

}
