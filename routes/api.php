<?php

use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleBookmarksRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticleCommentsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticleController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesAuthorsRelationshipsController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelatedController;
use App\Http\Controllers\Admin\Article\AdminArticlesTagsRelationshipsController;
use App\Http\Controllers\Admin\Author\AdminAuthorController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelatedController;
use App\Http\Controllers\Admin\Author\AdminAuthorsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelatedController;
use App\Http\Controllers\Admin\Biography\AdminBiographyCommentsRelationshipsController;
use App\Http\Controllers\Admin\Biography\AdminBiographyController;
use App\Http\Controllers\Admin\Comment\AdminCommentController;
use App\Http\Controllers\Admin\Document\AdminDocumentController;
use App\Http\Controllers\Admin\Image\AdminImageController;
use App\Http\Controllers\Admin\News\AdminNewsController;
use App\Http\Controllers\Admin\Question\AdminQuestionController;
use App\Http\Controllers\Admin\Tag\AdminTagController;
use App\Http\Controllers\Admin\Tag\AdminTagsArticlesRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestCommentsRelationshipsController;
use App\Http\Controllers\Admin\Test\AdminTestController;
use App\Http\Controllers\Admin\Article\AdminArticleImagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelatedController;
use App\Http\Controllers\Admin\Test\AdminTestImagesRelationshipsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AudiomaterialController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LikeController;
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

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

            Route::get('/like', [LikeController::class, 'like']);

            Route::post('/comments', [CommentController::class, 'store']);
            Route::delete('/comments/{comment:id}', [CommentController::class, 'destroy']);


            // Admins
            Route::middleware('admin')->group(function () {

                /*****************  ARTICLES ROUTES **************/

                Route::apiResource('admin/articles', AdminArticleController::class, ['as' =>'admin']);

                // Articles to Authors relations
                Route::get('/admin/articles/{article}/relatioships/authors', [
                    AdminArticlesAuthorsRelationshipsController::class, 'index'
                ])->name('articles.relationships.authors');

                Route::patch('/admin/articles/{article}/relatioships/authors', [
                    AdminArticlesAuthorsRelationshipsController::class, 'update'
                ])->name('articles.relationships.authors');

                Route::get('admin/articles/{article}/authors', [
                    AdminArticlesAuthorsRelatedController::class, 'index'
                ])->name('articles.authors');

                // Articles to Bookmarks relations
                Route::get('/admin/articles/{article}/relatioships/bookmarks', [
                    AdminArticleBookmarksRelationshipsController::class, 'index'
                ])->name('article.relationships.bookmarks');

                Route::patch('/admin/articles/{article}/relatioships/bookmarks', [
                    AdminArticleBookmarksRelationshipsController::class, 'update'
                ])->name('article.relationships.bookmarks');

                Route::get('admin/articles/{article}/bookmarks', [
                    AdminArticleBookmarksRelatedController::class, 'index'
                ])->name('article.bookmarks');

                // Article to Comments relations
                Route::get('/admin/articles/{article}/relatioships/comments', [
                    AdminArticleCommentsRelationshipsController::class, 'index'
                ])->name('article.relationships.comments');

                Route::patch('/admin/articles/{article}/relatioships/comments', [
                    AdminArticleCommentsRelationshipsController::class, 'update'
                ])->name('article.relationships.comments');

                Route::get('admin/articles/{article}/comments', [
                    AdminArticleCommentsRelatedController::class, 'index'
                ])->name('article.comments');

                // Article to Images relations
                Route::get('/admin/articles/{article}/relatioships/images', [
                    AdminArticleImagesRelationshipsController::class, 'index'
                ])->name('article.relationships.images');

                Route::patch('/admin/articles/{article}/relatioships/images', [
                    AdminArticleImagesRelationshipsController::class, 'update'
                ])->name('article.relationships.images');

                Route::get('admin/articles/{article}/images', [
                    AdminArticleImagesRelatedController::class, 'index'
                ])->name('article.images');

                // Articles to Tags relations
                Route::get('/admin/articles/{article}/relatioships/tags', [
                    AdminArticlesTagsRelationshipsController::class, 'index'
                ])->name('articles.relationships.tags');

                Route::patch('/admin/articles/{article}/relatioships/tags', [
                    AdminArticlesTagsRelationshipsController::class, 'update'
                ])->name('articles.relationships.tags');

                Route::get('admin/articles/{article}/tags', [
                    AdminArticlesTagsRelatedController::class, 'index'
                ])->name('articles.tags');

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

                /*****************  COMMENTS ROUTES **************/

                Route::get('admin/comments', [AdminCommentController::class, 'index']);
                Route::get('admin/comments/{comment}', [AdminCommentController::class, 'show'])
                    ->name('admin.comments.show');
//                Route::post('admin/comments', [AdminCommentController::class, 'store']);
//                Route::patch('admin/comments/{comment}', [AdminCommentController::class, 'update']);
//                Route::delete('admin/comments/{comment}', [AdminCommentController::class, 'delete']);

                /*****************  DOCUMENTS ROUTES **************/

                Route::get('/admin/documents', [AdminDocumentController::class, 'index']);
                Route::get('/admin/documents/{document}', [AdminDocumentController::class, 'show'])
                    ->name('admin.documents.show');
                Route::post('/admin/documents', [AdminDocumentController::class, 'store']);
                Route::patch('/admin/documents/{document}', [AdminDocumentController::class, 'update']);
                Route::delete('/admin/documents/{document}', [AdminDocumentController::class, 'destroy']);

                /*****************  IMAGES ROUTES **************/

                Route::get('/admin/images', [AdminImageController::class, 'index']);
                Route::get('/admin/images/{image}', [AdminImageController::class, 'show'])
                    ->name('admin.images.show');
                Route::post('/admin/images', [AdminImageController::class, 'store']);
                Route::patch('/admin/images/{image}', [AdminImageController::class, 'update']);
                Route::delete('/admin/images/{image}', [AdminImageController::class, 'destroy']);
                Route::post('/admin/images/loader', [AdminImageController::class, 'loadImage']);

                /*****************  NEWS ROUTES **************/

                Route::get('/admin/news', [AdminNewsController::class, 'index']);
                Route::get('/admin/news/{news}', [AdminNewsController::class, 'show'])
                    ->name('admin.news.show');
                Route::post('/admin/news', [AdminNewsController::class, 'store']);
                Route::patch('/admin/news/{news}', [AdminNewsController::class, 'update']);
                Route::delete('/admin/news/{news}', [AdminNewsController::class, 'destroy']);

                /*****************  QUESTIONS ROUTES **************/

                Route::apiResource('/admin/questions', AdminQuestionController::class, ['as' => 'admin']);

                /*****************  TAGS ROUTES **************/

                Route::get('/admin/tags', [AdminTagController::class, 'index']);
                Route::get('/admin/tags/{tag}', [AdminTagController::class, 'show'])
                ->name('admin.tags.show');
                Route::post('/admin/tags', [AdminTagController::class, 'store']);
                Route::patch('/admin/tags/{tag}', [AdminTagController::class, 'update']);
                Route::delete('/admin/tags/{tag}', [AdminTagController::class, 'destroy']);

                // Tags to Articles relations
                Route::get('/admin/tags/{tag}/relatioships/articles', [
                    AdminTagsArticlesRelationshipsController::class, 'index'
                ])->name('tags.relationships.articles');

                Route::patch('/admin/tags/{tag}/relatioships/articles', [
                    AdminTagsArticlesRelationshipsController::class, 'update'
                ])->name('tags.relationships.articles');

                Route::get('admin/tags/{tag}/articles', [
                    AdminArticlesTagsRelatedController::class, 'index'
                ])->name('tags.articles');

                /*****************  TESTS ROUTES **************/

                Route::get('/admin/tests', [AdminTestController::class, 'index']);
                Route::get('/admin/tests/{test}', [AdminTestController::class, 'show'])
                    ->name('admin.tests.show');
                Route::post('/admin/tests', [AdminTestController::class, 'store']);
                Route::patch('/admin/tests/{test}', [AdminTestController::class, 'update']);
                Route::delete('/admin/tests/{test}', [AdminTestController::class, 'destroy']);

                // Test to Comments relations
                Route::get('/admin/tests/{test}/relationships/comments', [
                    AdminTestCommentsRelationshipsController::class, 'index'
                ])->name('test.relationships.comments');

                Route::patch('/admin/tests/{test}/relationships/comments', [
                    AdminTestCommentsRelationshipsController::class, 'update'
                ])->name('test.relationships.comments');

                Route::get('/admin/tests/{test}/comments', [
                    AdminTestCommentsRelatedController::class, 'index'
                ])->name('test.comments');

                // Test to Images relations
                Route::get('/admin/tests/{test}/relationships/images', [
                    AdminTestImagesRelationshipsController::class, 'index'
                ])->name('test.relationships.images');

                Route::patch('/admin/tests/{test}/relationships/images', [
                    AdminTestImagesRelationshipsController::class, 'update'
                ])->name('test.relationships.images');

                Route::get('/admin/tests/{test}/images', [
                    AdminTestImagesRelatedController::class, 'index'
                ])->name('test.images');
            });
        }
    );

    Route::middleware('user')->group(
        function () {

            Route::get('/articles', [ArticleController::class, 'index']);
            Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

            Route::get('/authors', [AuthorController::class, 'index']);
            Route::get('/authors/{author:slug}', [AuthorController::class, 'show'])->name('authors.show');
            Route::get('/authors/{author:slug}/articles', [AuthorController::class, 'getArticles']);

            Route::get('/comments', [CommentController::class, 'index']);
            Route::get('/comments/answers/{comment:id}', [CommentController::class, 'getAnswers']);

            Route::get('/audiolectures', [AudiomaterialController::class, 'index']);
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
            Route::get('/films/{videomaterial:slug}', [\App\Http\Controllers\FilmsController::class, 'show']);

            Route::get('/videolectures', [\App\Http\Controllers\VideolectureController::class, 'index']);
            Route::get('/videolectures/{videomaterial:slug}', [\App\Http\Controllers\VideolectureController::class, 'show']);

            Route::get('/courses/video', [\App\Http\Controllers\CourseController::class, 'getVideocourses']);
            Route::get('/courses/audio', [\App\Http\Controllers\CourseController::class, 'getAudiocourses']);
            Route::get('/courses/courses', [\App\Http\Controllers\CourseController::class, 'getCourses']);
            Route::get('/courses/{highlight:slug}', [\App\Http\Controllers\CourseController::class, 'show']);


            Route::get('/highlights', [\App\Http\Controllers\HighlightController::class, 'index']);
            Route::get('/highlights/{highlight:slug}', [\App\Http\Controllers\HighlightController::class, 'show']);

            Route::get('/news/', [NewsController::class, 'index']);
            Route::get('/news/{news:slug}', [NewsController::class, 'show']);

            Route::get('/subscription/', [\App\Http\Controllers\SubscriptionController::class,'getAll']);


        }
    );

    // Common routes

    Route::get('/popular/articles', [PopularController::class, 'articles']);
    Route::get('/popular/comments', [PopularController::class, 'comments'])->name('popular.comments');


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
});
