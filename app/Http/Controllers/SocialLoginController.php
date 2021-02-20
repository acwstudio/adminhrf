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

    /**
     * Create a new controller instance.
     *
     * @param  StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }


    public function redirect($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }

    public function callback($service, Request $request)
    {

        $oauthUser = Socialite::driver($service)->stateless()->user();

        dd($oauthUser);

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

        $this->guard->login($socialUser->user);


        dd($socialUser->user);

//        return redirect(env('CLIENT_BASE_URL') . '/logged');
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
