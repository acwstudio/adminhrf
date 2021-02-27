<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

// Common routes
    Route::get('/articles',[ArticleController::class, 'index']);


//Articles:
    Route::get('articles-tags/{tagId}', 'App\Http\Controllers\ArticleController@getArticlesByTag');
    Route::get('articles-author/{authorId}', 'App\Http\Controllers\ArticleController@getArticlesByAuthor');
    Route::get('articles-announce', 'App\Http\Controllers\ArticleController@getAnnounceList');

//News:
    Route::get('/news/list/{page}', [\App\Http\Controllers\NewsController::class, 'getAnnounceNews']);
    Route::get('/news/tags/{tagId}/{page}', [\App\Http\Controllers\NewsController::class, 'getNewsByTag']);
#Route::get('/news/tags/{tagId}-page-{page}', [\App\Http\Controllers\NewsController::class, 'getNewsByTag']);
    Route::get('/news/{id}', [\App\Http\Controllers\NewsController::class, 'getNews']);

//Events
    Route::get('/events/announce/century/{century}', [\App\Http\Controllers\EventController::class, 'getEventsForCentury']);
    Route::get('/events/announce/decade/{decade}', [\App\Http\Controllers\EventController::class, 'getEventsForDecade']);
    Route::get('/events/{id}', [\App\Http\Controllers\EventController::class, 'getEventById']);





});
