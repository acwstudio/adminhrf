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
            'document' => 'App\Models\Document',
            'news' => 'App\Models\News',
            'biography' => 'App\Models\Biography',
            'author' => 'App\Models\Author',
            'test' => 'App\Models\Test',
            'question' => 'App\Models\Question',
            'answer' => 'App\Models\ResultAnswer',
            'timeline' => 'App\Models\Timeline',
            'comment' => 'App\Models\Comment',
            'videomaterial' => 'App\Models\Videomaterial',
            'audiomaterial' => 'App\Models\Audiomaterial',
            'afisha' => 'App\Models\Event',
            'highlight' => 'App\Models\Highlight',
            'podcast' => 'App\Models\Podcast',
            'dayinhistory' => 'App\Models\DayInHistory',
            'user' => 'App\Models\User'
        ]);

        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return config('app.client_url')."?type=reset_password&token={$token}&email={$notifiable->getEmailForPasswordReset()}";

            }
        );

        VerifyEmail::createUrlUsing(
            function ($notifiable) {
                $email = $notifiable->getEmailForVerification();
                $hash = Hash::make($email);

                return config('app.url')."/api/v1/email/verify/{$email}?hash={$hash}";
            }
        );
    }
}
