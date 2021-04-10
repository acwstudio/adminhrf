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
                    return redirect(config('app.client_url') . "?type=email_confirm&email_verified={$email}");
                }

                if ($user->markEmailAsVerified()) {
                    event(new Verified($user));
                    return redirect(config('app.client_url') . "?type=email_confirm&email_verified={$email}");
                }
            }
        }

        return redirect(config('app.client_url') . '?type=email_confirm&email_verified=false');

    }
}
