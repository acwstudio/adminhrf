<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'article' => 'App\Models\Article',
        ]);

        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return env("APP_CLIENT_URL") . "?type=reset_password&token={$token}&email={$notifiable->getEmailForPasswordReset()}";

            }
        );

        VerifyEmail::createUrlUsing(
            function ($notifiable) {
                $email = $notifiable->getEmailForVerification();
                $hash = Hash::make($email);

                return env("APP_URL") . "/api/v1/email/verify/{$email}?hash={$hash}";
            }
        );
    }
}
