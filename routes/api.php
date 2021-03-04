<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\TokenAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use App\Actions\Fortify\EmailVerify;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')->group(function () {

    Route::middleware('guest')->group(
        function () {
            $limiter = config('fortify.limiters.login');

            Route::post('/token', [TokenAuthController::class, 'store'])->middleware(
                array_filter([$limiter ? 'throttle:' . $limiter : null])
            );

            Route::get('/email/verify/{email}', [EmailVerify::class, 'verify'])
                ->middleware(['throttle:6,1'])
                ->name('verification.verify');

        }

    );


    // Social login
    Route::get('/login/{service}', [SocialLoginController::class, 'redirect'])
        ->name('social.redirect');
    Route::get('/login/{service}/callback', [SocialLoginController::class, 'callback'])
        ->name('social.callback');

    // Protected routes

    Route::middleware('auth:sanctum')->group(
        function () {

            Route::delete('/token', [TokenAuthController::class, 'destroy']);

            Route::get('/me', [UserController::class, 'me']);

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

        }
    );

    // Common routes
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);

    //News:
    Route::get('/news/', [\App\Http\Controllers\NewsController::class, 'getAnnounceNews']);
#Route::get('/news/tags/{tagId}-page-{page}', [\App\Http\Controllers\NewsController::class, 'getNewsByTag']);
    Route::get('/news/{id}', [\App\Http\Controllers\NewsController::class, 'getNews']);

    #Route::get('/news/tags/{tagId}/{page}', [\App\Http\Controllers\NewsController::class, 'getNewsByTag']);
    Route::get('/tags/news/{tagId}', [\App\Http\Controllers\TagController::class, 'getNews']);
    Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    //Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    //Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);



});
