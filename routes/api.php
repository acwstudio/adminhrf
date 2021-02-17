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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

#Route::apiResource('articles', \App\Http\Controllers\ArticleController::class);
#Route::resource('articles', \App\Http\Controllers\ArticleController::class);
#Route::apiResource('/v1/articles', 'App\Http\Controllers\ArticleController');
#Route::get($uri, $callback);
#Route::Resource('articles', 'App\Http\Controllers\ArticleController');
Route::get('articles-tags/{tagId}', 'App\Http\Controllers\ArticleController@getArticlesByTag');
Route::get('articles-author/{authorId}', 'App\Http\Controllers\ArticleController@getArticlesByAuthor');
Route::get('articles-announce', 'App\Http\Controllers\ArticleController@getAnnounceList');
#Route::get('articles', 'App\Http\Controllers\ArticleController@index');
#Route::post('articles', 'App\Http\Controllers\ArticleController@store');
#Route::get('articles/{id}', 'App\Http\Controllers\ArticleController@show');
#Route::get('articles/create', 'App\Http\Controllers\ArticleController@create');
#Route::put('students/{id}', 'ApiController@updateStudent');
#Route::delete('students/{id}','ApiController@deleteStudent');


