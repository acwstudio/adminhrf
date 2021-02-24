<?php


namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmailVerify
{
    /**
     * Verify user email
     *
     * @param Request $request
     * @param $email
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify(Request $request, $email)
    {

        if (Hash::check($email, (string) $request->get('hash'))) {

            if ($user = User::where('email', $email)->first()) {

                if ($user->hasVerifiedEmail()) {
                    return redirect(env('APP_CLIENT_URL') . "?email_verified={$email}");
                }

                if ($user->markEmailAsVerified()) {
                    event(new Verified($user));
                    return redirect(env('APP_CLIENT_URL') . "?email_verified={$email}");
                }
            }
        }

        return redirect(env('APP_CLIENT_URL') . '?email_verified=false');

    }
}
