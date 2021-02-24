<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\SocialUser;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Socialite\Facades\Socialite;

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

    public function callback($service, Request $request)
    {

        $oauthUser = Socialite::driver($service)->stateless()->user();


        $socialUser = SocialUser::where('external_id', $oauthUser->id)
            ->where('service', $service)
            ->first();


        if(is_null($socialUser)) {

            $user = $this->checkUser($oauthUser);

            $socialUser = new SocialUser();

            $socialUser->external_id = $oauthUser->id;
            $socialUser->service = $service;
            $socialUser->external_user = $oauthUser->user;
            $socialUser->user()->associate($user);

            $socialUser->save();

        }

        $token = $socialUser->user->createToken($service, ['user:social']);

        return redirect(env('CLIENT_BASE_URL') . '?type=social_login', 302, ['token' => $token->plainTextToken]);
    }


    protected function checkUser($oauthUser): User
    {
        $user = null;
        if(!is_null($oauthUser->email)) {
            $user = User::firstWhere('email', $oauthUser->email);
        }

        if(is_null($user)) {
            $user = User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email
            ]);
        }

        return $user;

    }

}
