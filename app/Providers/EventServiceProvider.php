<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Liked;
use App\Events\Disliked;
use App\Listeners\IncrementLikedCounter;
use App\Listeners\DecrementLikedCounter;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [

            'SocialiteProviders\\Facebook\\FacebookExtendSocialite@handle',
            'SocialiteProviders\\Google\\GoogleExtendSocialite@handle',
            'SocialiteProviders\\Odnoklassniki\\OdnoklassnikiExtendSocialite@handle',
            'SocialiteProviders\\VKontakte\\VKontakteExtendSocialite@handle',
            'SocialiteProviders\\Yandex\\YandexExtendSocialite@handle',
//            'SocialiteProviders\\Twitter\\TwitterExtendSocialite@handle',

        ],

        Liked::class => [
            IncrementLikedCounter::class,
        ],

        Disliked::class => [
            DecrementLikedCounter::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
