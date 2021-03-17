<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NewsController;
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
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::patch('/articles/{article:slug}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article:slug}', [ArticleController::class, 'destroy'])->name('articles.delete');

    Route::get('/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{category:slug}', [DocumentController::class, 'documents']);
    Route::get('/documents/{category:slug}/{document:slug}', [DocumentController::class, 'show']);

    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.posts');
    Route::patch('/authors/{author:slug}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author:slug}', [AuthorController::class, 'destroy'])->name('authors.delete');

    Route::get('/news/', [NewsController::class, 'index']);
    Route::get('/news/{news:slug}', [NewsController::class, 'show']);

    Route::get('/tags/news/{tagId}', [\App\Http\Controllers\TagController::class, 'getNews']);
    Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    //Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    //Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    Route::get('/tags/all/{tagId}', [\App\Http\Controllers\TagController::class, 'getAll']);
    Route::get('/comments/{model}/{id}', [\App\Http\Controllers\CommentsController::class, 'getCommentsForModel']);
   # Route::get('/comments/user/{id}', [\App\Http\Controllers\CommentsController::class, 'getCommentsFromUser']);
    Route::get('/bookmarks/', [\App\Http\Controllers\BookmarkController::class,'getBookmarks']);
    Route::get('/bookmarks/{action}', [\App\Http\Controllers\BookmarkController::class,'getBookmarksActions']);


    Route::get('/subscription/', [\App\Http\Controllers\SubscriptionController::class,'getAll']);

    Route::get('/biographies', [BiographyController::class,'index']);
    Route::get('/biographies/categories', [BiographyController::class,'categories']);
    Route::get('/biographies/{biography:slug}', [BiographyController::class,'show'])->name('biographies.show');
    Route::post('/biographies', [BiographyController::class,'store']);
    Route::patch('/biographies/{biography:slug}', [BiographyController::class,'update']);
    Route::delete('/biographies/{biography:slug}', [BiographyController::class,'destroy']);

    Route::get('/timeline/events', [\App\Http\Controllers\TimeLineController::class,'getEvents']);
    Route::get('/timeline/biographies', [\App\Http\Controllers\TimeLineController::class,'getBios']);
    Route::get('/timeline/', [\App\Http\Controllers\TimeLineController::class,'getAll']);


});
