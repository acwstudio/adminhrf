<?php

use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminArticlesAuthorsRelatedController;
use App\Http\Controllers\Admin\AdminArticlesAuthorsRelationshipsController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminAuthorsArticlesRelatedController;
use App\Http\Controllers\Admin\AdminAuthorsArticlesRelationshipsController;
use App\Http\Controllers\Admin\AdminBiographyCommentsRelatedController;
use App\Http\Controllers\Admin\AdminBiographyCommentsRelationshipsController;
use App\Http\Controllers\Admin\AdminBiographyController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminImageController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudiomaterialController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PopularController;
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
            Route::post('/avatar', [UserController::class, 'avatarStore']);
            Route::delete('/avatar', [UserController::class, 'avatarDelete']);

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

            Route::get('/like', [LikeController::class, 'like']);

            Route::post('/comments', [CommentController::class, 'store']);
            Route::delete('/comments/{comment:id}', [CommentController::class, 'destroy']);


            // Admins
            Route::middleware('admin')->group(function () {

                /*****************  ARTICLES ROUTES **************/

                Route::get('/admin/articles', [AdminArticleController::class, 'index']);
                Route::get('/admin/articles/{article}', [AdminArticleController::class, 'show'])
                    ->name('admin.articles.show');
                Route::post('/admin/articles', [AdminArticleController::class, 'store']);
                Route::patch('/admin/articles/{article}', [AdminArticleController::class, 'update']);
                Route::delete('/admin/articles/{article}', [AdminArticleController::class, 'destroy']);

                Route::get('/admin/articles/{article}/relatioships/authors', [
                    AdminArticlesAuthorsRelationshipsController::class, 'index'
                ])->name('articles.relationships.authors');

                Route::patch('/admin/articles/{article}/relatioships/authors', [
                    AdminArticlesAuthorsRelationshipsController::class, 'update'
                ])->name('articles.relationships.authors');

                Route::get('admin/articles/{article}/authors', [
                    AdminArticlesAuthorsRelatedController::class, 'index'
                ])->name('articles.authors');

                /*****************  AUTHORS ROUTES **************/

                Route::get('/admin/authors', [AdminAuthorController::class, 'index']);
                Route::get('/admin/authors/{author}', [AdminAuthorController::class, 'show'])
                    ->name('admin.authors.show');
                Route::post('/admin/authors', [AdminAuthorController::class, 'store']);
                Route::patch('/admin/authors/{author}', [AdminAuthorController::class, 'update']);
                Route::delete('/admin/authors/{author}', [AdminAuthorController::class, 'destroy']);

                Route::get('/admin/authors/{author}/relatioships/articles', [
                    AdminAuthorsArticlesRelationshipsController::class, 'index'
                ])->name('authors.relationships.articles');

                Route::patch('/admin/authors/{author}/relatioships/articles', [
                    AdminAuthorsArticlesRelationshipsController::class, 'update'
                ])->name('authors.relationships.articles');

                Route::get('admin/authors/{author}/articles', [
                    AdminAuthorsArticlesRelatedController::class, 'index'
                ])->name('authors.articles');

                /*****************  BIOGRAPHIES ROUTES **************/

                Route::get('/admin/biographies', [AdminBiographyController::class, 'index']);
                Route::get('/admin/biographies/{biography}', [AdminBiographyController::class, 'show'])
                    ->name('admin.biographies.show');
                Route::post('/admin/biographies', [AdminBiographyController::class, 'store']);
                Route::patch('/admin/biographies/{biography}', [AdminBiographyController::class, 'update']);
                Route::delete('/admin/biographies/{biography}', [AdminBiographyController::class, 'destroy']);

                Route::get('/admin/biographies/{biography}/relatioships/comments', [
                    AdminBiographyCommentsRelationshipsController::class, 'index'
                ])->name('biography.relationships.comments');

                Route::patch('/admin/biographies/{biography}/relatioships/comments', [
                    AdminBiographyCommentsRelationshipsController::class, 'update'
                ])->name('biography.relationships.comments');

                Route::get('admin/biographies/{biography}/comments', [
                    AdminBiographyCommentsRelatedController::class, 'index'
                ])->name('biography.comments');

                /*****************  DOCUMENTS ROUTES **************/

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

                Route::get('/admin/images', [AdminImageController::class, 'index']);
                Route::get('/admin/images/{image}', [AdminImageController::class, 'show'])
                    ->name('admin.images.show');
                Route::post('/admin/images', [AdminImageController::class, 'store']);
                Route::post('/admin/images/{image}', [AdminImageController::class, 'update']);
                Route::delete('/admin/images/{image}', [AdminImageController::class, 'destroy']);

                Route::get('admin/comments', [AdminCommentController::class, 'index']);
                Route::get('admin/comments/{comment}', [AdminCommentController::class, 'show'])
                    ->name('admin.comments.show');
//                Route::post('admin/comments', [AdminCommentController::class, 'store']);
//                Route::patch('admin/comments/{comment}', [AdminCommentController::class, 'update']);
//                Route::delete('admin/comments/{comment}', [AdminCommentController::class, 'delete']);
            });
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

            Route::get('/bookmarks/', [\App\Http\Controllers\BookmarkController::class,'getBookmarks']);
            Route::get('/bookmarks/{action}', [\App\Http\Controllers\BookmarkController::class,'getBookmarksActions']);
            Route::post('/bookmarks/set', [\App\Http\Controllers\BookmarkController::class,'setBookmark']);

            Route::get('/biographies', [BiographyController::class,'index']);
            Route::get('/biographies/categories', [BiographyController::class,'categories']);
            Route::get('/biographies/{biography:slug}', [BiographyController::class,'show'])->name('biographies.show');

            Route::get('/timeline/events/{article:slug}', [\App\Http\Controllers\TimeLineController::class,'getEvent']);
            Route::get('/timeline/biographies/{biography:slug}', [\App\Http\Controllers\TimeLineController::class,'getBiography']);
            Route::get('/timeline', [\App\Http\Controllers\TimeLineController::class,'getAll']);

            Route::get('/tests', [\App\Http\Controllers\TestController::class, 'index']);
            Route::get('/tests/{test:id}', [\App\Http\Controllers\TestController::class, 'show']);
            Route::get('/tests/result/{test:id}', [\App\Http\Controllers\TestController::class, 'postResult']);

            Route::get('/films', [\App\Http\Controllers\FilmsController::class, 'index']);
            Route::get('/films/tags/{tag:slug}', [\App\Http\Controllers\FilmsController::class, 'indexByTag']);
            Route::get('/films/{videomaterial:slug}', [\App\Http\Controllers\FilmsController::class, 'show']);

            Route::get('/videolectures', [\App\Http\Controllers\VideolectureController::class, 'index']);
            Route::get('/videolectures/tags/{tag:slug}', [\App\Http\Controllers\VideolectureController::class, 'indexByTag']);
            Route::get('/videolectures/{videomaterial:slug}', [\App\Http\Controllers\VideolectureController::class, 'show']);

            Route::get('/afisha', [\App\Http\Controllers\AfishaController::class, 'index']);
            Route::get('/afisha/categories', [\App\Http\Controllers\AfishaController::class, 'categories']);
            Route::get('/afisha/{event:id}', [\App\Http\Controllers\AfishaController::class, 'show']);

            Route::get('/courses/video', [\App\Http\Controllers\CourseController::class, 'getVideocourses']);
            Route::get('/courses/audio', [\App\Http\Controllers\CourseController::class, 'getAudiocourses']);
            Route::get('/courses/courses', [\App\Http\Controllers\CourseController::class, 'getCourses']);
            Route::get('/courses/{highlight:slug}', [\App\Http\Controllers\CourseController::class, 'show']);
            Route::get('/courses/video/tags/{slug}', [\App\Http\Controllers\CourseController::class, 'getVideocoursesByTag']);
            Route::get('/courses/audio/tags/{slug}', [\App\Http\Controllers\CourseController::class, 'getAudiocoursesByTag']);
            Route::get('/courses/courses/tags/{slug}', [\App\Http\Controllers\CourseController::class, 'getCoursesByTag']);
            Route::get('/courses/{highlight:slug}', [\App\Http\Controllers\CourseController::class, 'show']);


            Route::get('/highlights', [\App\Http\Controllers\HighlightController::class, 'index']);
            Route::get('/highlights/tags/{tag:slug}', [\App\Http\Controllers\HighlightController::class, 'indexByTag']);
            Route::get('/highlights/{highlight:slug}', [\App\Http\Controllers\HighlightController::class, 'show']);

            Route::get('/news/', [NewsController::class, 'index']);
            Route::get('/news/tags/{tag:slug}', [NewsController::class, 'indexByTag']);
            Route::get('/news/{news:slug}', [NewsController::class, 'show']);

            Route::get('/subscription/', [\App\Http\Controllers\SubscriptionController::class,'index']);
            Route::get('/subscription/{tag:id}', [\App\Http\Controllers\SubscriptionController::class,'subscribe']);


        }
    );

    // Common routes

    Route::get('/popular/articles', [PopularController::class, 'articles']);
    Route::get('/popular/comments', [PopularController::class, 'comments'])->name('popular.comments');

    Route::get('/dayinhistory', [\App\Http\Controllers\dayInHistoryController::class, 'getDays']);

    Route::get('/documents', [DocumentController::class, 'index']);
    Route::get('/documents/{category:slug}', [DocumentController::class, 'documents']);
    Route::get('/documents/{category:slug}/{document:slug}', [DocumentController::class, 'show']);


    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.posts');
    Route::patch('/authors/{author:slug}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author:slug}', [AuthorController::class, 'destroy'])->name('authors.delete');
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');

    Route::get('/tags/news/{tagId}', [\App\Http\Controllers\TagController::class, 'getNews']);
    Route::get('/tags/articles/{tagId}', [\App\Http\Controllers\TagController::class, 'getArticles']);
    Route::get('/tags/all/{tagId}', [\App\Http\Controllers\TagController::class, 'getAll']);


    Route::get('/random/news/', [\App\Http\Controllers\RandController::class, 'getRandNews']);
    Route::get('/random/articles/', [\App\Http\Controllers\RandController::class, 'getRandArticles']);
    Route::get('/random/biographies/', [\App\Http\Controllers\RandController::class, 'getRandBiographies']);
    Route::get('/random/videolectures/', [\App\Http\Controllers\RandController::class, 'getRandVideolectures']);
    Route::get('/random/audiolectures/', [\App\Http\Controllers\RandController::class, 'getRandAudiolectures']);
    Route::get('/random/films/', [\App\Http\Controllers\RandController::class, 'getRandFilms']);
    Route::get('/random/tests/', [\App\Http\Controllers\RandController::class, 'getRandTest']);
    Route::get('/random/courses/', [\App\Http\Controllers\RandController::class, 'getRandCourses']);
    Route::get('/random/audiocourses/', [\App\Http\Controllers\RandController::class, 'getRandAudioCourses']);
    Route::get('/random/videocourses/', [\App\Http\Controllers\RandController::class, 'getRandVideoCourses']);
    Route::get('/random/highlights/', [\App\Http\Controllers\RandController::class, 'getRandHighlights']);
    Route::get('/random/podcasts/', [\App\Http\Controllers\RandController::class, 'getRandPodcasts']);


    Route::get('/magazine/', [MagazineController::class, 'index']);


});
