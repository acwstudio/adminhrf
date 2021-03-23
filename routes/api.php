<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminBiographyController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LikeController;
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

            // Admins
            Route::middleware('admin')->group(function () {

                Route::get('/admin/articles', [AdminArticleController::class, 'index']);
                Route::get('/admin/articles/{article:slug}', [AdminArticleController::class, 'show'])
                    ->name('admin.articles.show');
                Route::post('/admin/articles', [AdminArticleController::class, 'store']);
                Route::patch('/admin/articles/{article:slug}', [AdminArticleController::class, 'update']);
                Route::delete('/admin/articles/{article:slug}', [AdminArticleController::class, 'destroy']);

                Route::get('/admin/authors', [AdminAuthorController::class, 'index']);
                Route::get('/admin/authors/{author:slug}', [AdminAuthorController::class, 'show'])
                    ->name('admin.authors.show');
                Route::post('/admin/authors', [AdminAuthorController::class, 'store']);
                Route::patch('/admin/authors/{author:slug}', [AdminAuthorController::class, 'update']);
                Route::delete('/admin/authors/{author:slug}', [AdminAuthorController::class, 'destroy']);

                Route::get('/admin/biographies', [AdminBiographyController::class, 'index']);
                Route::get('/admin/biographies/{biography:slug}', [AdminBiographyController::class, 'show'])
                    ->name('admin.biographies.show');
                Route::post('/admin/biographies', [AdminBiographyController::class, 'store']);
                Route::patch('/admin/biographies/{biography:slug}', [AdminBiographyController::class, 'update']);
                Route::delete('/admin/biographies/{biography:slug}', [AdminBiographyController::class, 'destroy']);

                Route::get('/admin/documents', [AdminDocumentController::class, 'index']);
                Route::get('/admin/documents/{document:slug}', [AdminDocumentController::class, 'show'])
                    ->name('admin.documents.show');
                Route::post('/admin/documents', [AdminDocumentController::class, 'store']);
                Route::patch('/admin/documents/{document:slug}', [AdminDocumentController::class, 'update']);
                Route::delete('/admin/documents/{document:slug}', [AdminDocumentController::class, 'destroy']);

                Route::get('/admin/news', [AdminNewsController::class, 'index']);
                Route::get('/admin/news/{news:slug}', [AdminNewsController::class, 'show'])
                    ->name('admin.news.show');
                Route::post('/admin/news', [AdminNewsController::class, 'store']);
                Route::patch('/admin/news/{news:slug}', [AdminNewsController::class, 'update']);
                Route::delete('/admin/news/{news:slug}', [AdminNewsController::class, 'destroy']);

                Route::get('/admin/tags', [AdminTagController::class, 'index']);
                Route::get('/admin/tags/{tag:slug}', [AdminTagController::class, 'show'])
                ->name('admin.tags.show');
                Route::post('/admin/tags', [AdminTagController::class, 'store']);
                Route::patch('/admin/tags/{tag:slug}', [AdminTagController::class, 'update']);
                Route::delete('/admin/tags/{tag:slug}', [AdminTagController::class, 'destroy']);

            });
        }
    );

    Route::middleware('user')->group(
        function () {

            Route::get('/articles', [ArticleController::class, 'index']);
            Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

            Route::get('/authors', [AuthorController::class, 'index']);
            Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');
        }
    );

    // Common routes

    Route::post('/articles', [ArticleController::class, 'store']);
    Route::patch('/articles/{article:slug}', [ArticleController::class, 'update']);
    Route::delete('/articles/{article:slug}', [ArticleController::class, 'destroy'])->name('articles.delete');
    // Common routes
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{category:slug}', [DocumentController::class, 'documents']);
    Route::get('/documents/{category:slug}/{document:slug}', [DocumentController::class, 'show']);


    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.posts');
    Route::patch('/authors/{author:slug}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author:slug}', [AuthorController::class, 'destroy'])->name('authors.delete');
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');

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

    Route::get('/timeline/events/{article:slug}', [\App\Http\Controllers\TimeLineController::class,'getEvent']);
    Route::get('/timeline/biographies/{biography:slug}', [\App\Http\Controllers\TimeLineController::class,'getBiography']);
    Route::get('/timeline', [\App\Http\Controllers\TimeLineController::class,'getAll']);

    Route::get('/tests', [\App\Http\Controllers\TestController::class, 'index']);
    Route::get('/tests/{test:id}', [\App\Http\Controllers\TestController::class, 'show']);
    Route::get('/tests/result/{test:id}', [\App\Http\Controllers\TestController::class, 'postResult']);

    Route::get('/films', [\App\Http\Controllers\FilmsController::class, 'index']);
    Route::get('/films/{videomaterial:slug}', [\App\Http\Controllers\FilmsController::class, 'show']);

    Route::get('/videolectures', [\App\Http\Controllers\VideolectureController::class, 'index']);
    Route::get('/videolectures/{videomaterial:slug}', [\App\Http\Controllers\VideolectureController::class, 'show']);

    Route::get('/courses/video', [\App\Http\Controllers\CourseController::class, 'getVideocourses']);
    Route::get('/courses/audio', [\App\Http\Controllers\CourseController::class, 'getAudiocourses']);
    Route::get('/courses/courses', [\App\Http\Controllers\CourseController::class, 'getCourses']);
    Route::get('/courses/{highlight:id}', [\App\Http\Controllers\CourseController::class, 'show']);


    Route::get('/highlights', [\App\Http\Controllers\VideolectureController::class, 'index']);
    Route::get('/highlights/{highlight:id}', [\App\Http\Controllers\VideolectureController::class, 'show']);

    Route::get('/random/news/', [\App\Http\Controllers\RandController::class, 'getRandNews']);
    Route::get('/random/articles/', [\App\Http\Controllers\RandController::class, 'getRandArticles']);
    Route::get('/random/biographies/', [\App\Http\Controllers\RandController::class, 'getRandBiographies']);
});
