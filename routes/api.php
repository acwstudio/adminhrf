<?php

use App\Http\Controllers\Site\ArticleController;
use App\Http\Controllers\Site\AudiomaterialController;
use App\Http\Controllers\Site\AuthorController;
use App\Http\Controllers\Site\BiographyController;
use App\Http\Controllers\Site\CommentController;
use App\Http\Controllers\Site\DocumentController;
use App\Http\Controllers\Site\LikeController;
use App\Http\Controllers\Site\MagazineController;
use App\Http\Controllers\Site\NewsController;
use App\Http\Controllers\Site\PodcastController;
use App\Http\Controllers\Site\PopularController;
use App\Http\Controllers\Site\RateController;
use App\Http\Controllers\Site\SocialLoginController;
use App\Http\Controllers\Site\TokenAuthController;
use App\Http\Controllers\Site\UserController;
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

            Route::get('/profile', [UserController::class, 'getProfile']);
            Route::post('/profile', [UserController::class, 'updateProfile']);
            Route::post('/avatar', [UserController::class, 'avatarStore']);
            Route::delete('/avatar', [UserController::class, 'avatarDelete']);
            Route::get('/profile/comments', [CommentController::class, 'getUserComments'])->name('profile.comments');


            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

            Route::get('/like', [LikeController::class, 'like']);

            Route::get('/rateup', [RateController::class, 'up']);
            Route::get('/ratedown', [RateController::class, 'down']);

            Route::post('/comments', [CommentController::class, 'store']);
            Route::delete('/comments/{comment:id}', [CommentController::class, 'destroy']);


            /************** ADMIN PART ***********/

            Route::middleware('admin')->group(function () {

                Route::prefix('admin')->group(__DIR__ . '/admin/apiAdmin.php');

            });

            /************ END ADMIN PART **********/
        }
    );

    Route::middleware('user')->group(
        function () {

            Route::get('/articles', [ArticleController::class, 'index']);
            Route::get('/articles/tags/{tag:slug}', [ArticleController::class, 'indexByTag']);
            Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

            Route::get('/authors', [AuthorController::class, 'index']);
            Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');
            Route::get('/authors/{author:slug}/articles', [AuthorController::class, 'getArticles']);

            Route::get('/comments', [CommentController::class, 'index']);
            Route::get('/comments/answers/{comment:id}', [CommentController::class, 'getAnswers']);

            Route::get('/audiolectures', [AudiomaterialController::class, 'index']);
            Route::get('/audiolectures/tags/{tag:slug}', [AudiomaterialController::class, 'indexByTag']);
            Route::get('/audiolectures/{audio:slug}', [AudiomaterialController::class, 'show']);

            Route::get('/podcasts', [PodcastController::class, 'index']);
            Route::get('/podcasts/{podcast:slug}', [PodcastController::class, 'show']);

            Route::get('/bookmarks/', [\App\Http\Controllers\Site\BookmarkController::class,'getBookmarks']);
            Route::get('/bookmarks/{action}', [\App\Http\Controllers\Site\BookmarkController::class,'getBookmarksActions']);
            Route::post('/bookmarks/set', [\App\Http\Controllers\Site\BookmarkController::class,'setBookmark']);
            Route::delete('/bookmarks/unset', [\App\Http\Controllers\Site\BookmarkController::class,'unsetBookmark']);

            Route::get('/biographies', [BiographyController::class,'index']);
            Route::get('/biographies/categories', [BiographyController::class,'categories']);
            Route::get('/biographies/{biography:slug}', [BiographyController::class,'show'])->name('biographies.show');

            Route::get('/timeline/events/{article:slug}', [\App\Http\Controllers\Site\TimeLineController::class,'getEvent']);
            Route::get('/timeline/biographies/{biography:slug}', [\App\Http\Controllers\Site\TimeLineController::class,'getBiography']);
            Route::get('/timeline', [\App\Http\Controllers\Site\TimeLineController::class,'getAll']);

            Route::get('/tests', [\App\Http\Controllers\Site\TestController::class, 'index']);
            Route::get('/tests/{test:id}', [\App\Http\Controllers\Site\TestController::class, 'show']);
            Route::get('/tests/result/{test:id}', [\App\Http\Controllers\Site\TestController::class, 'postResult']);

            Route::get('/films', [\App\Http\Controllers\Site\FilmsController::class, 'index']);
            Route::get('/films/tags/{tag:slug}', [\App\Http\Controllers\Site\FilmsController::class, 'indexByTag']);
            Route::get('/films/{videomaterial:slug}', [\App\Http\Controllers\Site\FilmsController::class, 'show']);

            Route::get('/videolectures', [\App\Http\Controllers\Site\VideolectureController::class, 'index']);
            Route::get('/videolectures/tags/{tag:slug}', [\App\Http\Controllers\Site\VideolectureController::class, 'indexByTag']);
            Route::get('/videolectures/{videomaterial:slug}', [\App\Http\Controllers\Site\VideolectureController::class, 'show']);

            Route::get('/afisha', [\App\Http\Controllers\Site\AfishaController::class, 'index']);
            Route::get('/afisha/all', [\App\Http\Controllers\Site\AfishaController::class, 'old']);
            Route::get('/afisha/categories', [\App\Http\Controllers\Site\AfishaController::class, 'categories']);
            Route::get('/afisha/{event:id}', [\App\Http\Controllers\Site\AfishaController::class, 'show']);

            Route::get('/courses/video', [\App\Http\Controllers\Site\CourseController::class, 'getVideocourses']);
            Route::get('/courses/audio', [\App\Http\Controllers\Site\CourseController::class, 'getAudiocourses']);
            Route::get('/courses/courses', [\App\Http\Controllers\Site\CourseController::class, 'getCourses']);
            Route::get('/courses/{highlight:slug}', [\App\Http\Controllers\Site\CourseController::class, 'show']);
            Route::get('/courses/video/tags/{slug}', [\App\Http\Controllers\Site\CourseController::class, 'getVideocoursesByTag']);
            Route::get('/courses/audio/tags/{slug}', [\App\Http\Controllers\Site\CourseController::class, 'getAudiocoursesByTag']);
            Route::get('/courses/courses/tags/{slug}', [\App\Http\Controllers\Site\CourseController::class, 'getCoursesByTag']);
            Route::get('/courses/{highlight:slug}', [\App\Http\Controllers\Site\CourseController::class, 'show']);

            Route::get('/themeoftheweek', [\App\Http\Controllers\Site\TempThemeOfTheWeekController::class, 'index']);
            Route::get('/highlights', [\App\Http\Controllers\Site\HighlightController::class, 'index']);
            Route::get('/highlights/tags/{tag:slug}', [\App\Http\Controllers\Site\HighlightController::class, 'indexByTag']);
            Route::get('/highlights/{highlight:slug}', [\App\Http\Controllers\Site\HighlightController::class, 'show']);

            Route::get('/news/', [NewsController::class, 'index']);
            Route::get('/news/tags/{tag:slug}', [NewsController::class, 'indexByTag']);
            Route::get('/news/{news:slug}', [NewsController::class, 'show']);

            Route::get('/subscription/', [\App\Http\Controllers\Site\SubscriptionController::class,'index']);
            Route::get('/subscription/{tag:id}', [\App\Http\Controllers\Site\SubscriptionController::class,'subscribe']);
            Route::get('/subscriptions/tags/', [\App\Http\Controllers\Site\SubscriptionController::class,'getTags']);
            //Route::get('/subscriptions/tags/', [\App\Http\Controllers\Site\SubscriptionController::class,'getTags']);

            Route::get('/search/{query}', [\App\Http\Controllers\Site\SearchController::class, 'articles']);//old Route
            Route::get('/search/articles/{query}', [\App\Http\Controllers\Site\SearchController::class, 'articles']);
            Route::get('/search/news/{query}', [\App\Http\Controllers\Site\SearchController::class, 'news']);
            Route::get('/search/biographies/{query}', [\App\Http\Controllers\Site\SearchController::class, 'biographies']);
            Route::get('/search/tests/{query}', [\App\Http\Controllers\Site\SearchController::class, 'tests']);
            Route::get('/search/videomaterials/{query}', [\App\Http\Controllers\Site\SearchController::class, 'videomaterials']);
        }
    );

    // Common routes

    Route::get('/popular/articles', [PopularController::class, 'articles']);
    Route::get('/popular/comments', [PopularController::class, 'comments'])->name('popular.comments');
    Route::get('/popular/reviews', [PopularController::class, 'reviews'])->name('popular.reviews');

    Route::get('/dayinhistory', [\App\Http\Controllers\Site\dayInHistoryController::class, 'getDays']);

    Route::get('/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{category:slug}', [DocumentController::class, 'documents']);
    Route::get('/documents/{category:slug}/{document:slug}', [DocumentController::class, 'show']);


    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.posts');
    Route::patch('/authors/{author:slug}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author:slug}', [AuthorController::class, 'destroy'])->name('authors.delete');
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');

    Route::get('/tags/news/{tagId}', [\App\Http\Controllers\Site\TagController::class, 'getNews']);
    Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\Site\TagController::class, 'getArticles']);
    Route::get('/tags/all/{tagId}', [\App\Http\Controllers\Site\TagController::class, 'getAll']);

    Route::get('/categories/article', [\App\Http\Controllers\Site\CategoryController::class, 'index']);

    //Route::get('/search/{query}', [\App\Http\Controllers\Site\SearchController::class, 'search']);

    Route::get('/random/news/', [\App\Http\Controllers\Site\RandController::class, 'getRandNews']);
    Route::get('/random/articles/', [\App\Http\Controllers\Site\RandController::class, 'getRandArticles']);
    Route::get('/random/biographies/', [\App\Http\Controllers\Site\RandController::class, 'getRandBiographies']);
    Route::get('/random/videolectures/', [\App\Http\Controllers\Site\RandController::class, 'getRandVideolectures']);
    Route::get('/random/audiolectures/', [\App\Http\Controllers\Site\RandController::class, 'getRandAudiolectures']);
    Route::get('/random/films/', [\App\Http\Controllers\Site\RandController::class, 'getRandFilms']);
    Route::get('/random/tests/', [\App\Http\Controllers\Site\RandController::class, 'getRandTest']);
    Route::get('/random/courses/', [\App\Http\Controllers\Site\RandController::class, 'getRandCourses']);
    Route::get('/random/audiocourses/', [\App\Http\Controllers\Site\RandController::class, 'getRandAudioCourses']);
    Route::get('/random/videocourses/', [\App\Http\Controllers\Site\RandController::class, 'getRandVideoCourses']);
    Route::get('/random/highlights/', [\App\Http\Controllers\Site\RandController::class, 'getRandHighlights']);
    Route::get('/random/podcasts/', [\App\Http\Controllers\Site\RandController::class, 'getRandPodcasts']);
    Route::get('/rss', [\App\Http\Controllers\Site\FeedController::class, 'rss']);
    //Route::get('/turbo-pages', [\App\Http\Controllers\Site\FeedController::class, 'turbo']);
    Route::get('/turbo/articles', [\App\Http\Controllers\Site\FeedController::class, 'turboArticles']);
    Route::get('/turbo/biographies', [\App\Http\Controllers\Site\FeedController::class, 'turboBiographies']);
    Route::get('/turbo/news', [\App\Http\Controllers\Site\FeedController::class, 'turboNews']);
    Route::get('/turbo/timeline', [\App\Http\Controllers\Site\FeedController::class, 'turboTimeline']);
    Route::get('/turbo/afisha', [\App\Http\Controllers\Site\FeedController::class, 'turboAfisha']);
    Route::get('/turbo/videolectures', [\App\Http\Controllers\Site\FeedController::class, 'turboVideolectures']);
    Route::get('/turbo/films', [\App\Http\Controllers\Site\FeedController::class, 'turboFilms']);

    //Route::get('/magazine/', [MagazineController::class, 'index']);
    Route::get('/magazine/', [MagazineController::class, 'indexMagazines']);
    Route::get('/magazine/{category:id}', [MagazineController::class, 'show']);
    Route::get('/magazine/category/{article:id}', [MagazineController::class, 'showArticle']);


});
