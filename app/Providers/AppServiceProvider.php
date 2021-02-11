<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
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
        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return env("APP_CLIENT_URL", "http://histrf-api.test:5000") . "/reset-password/{$token}?email={$notifiable->getEmailForPasswordReset()}";
            }
        );

        VerifyEmail::createUrlUsing(
            function () {
                return env("APP_CLIENT_URL", "http://histrf-api.test:5000") . "/email-verified";
            }
        );
    }
}
