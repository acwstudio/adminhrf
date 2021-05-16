<?php


use App\Http\Controllers\Admin\AllContent\AdminAllContentController;
use App\Http\Controllers\Admin\Author\AdminAuthorController;
use App\Http\Controllers\Admin\Image\AdminImageController;
use App\Http\Controllers\Site\TempTestingController;
use App\Http\Controllers\TestingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/v1/testing_controller/{method}', [TempTestingController::class, 'index']);
//Route::get('/images-admin/{image}', [AdminImageController::class, 'show']);
//Route::get('/all-content', [AdminAllContentController::class, 'index']);
Route::get('/test-author', [AdminAuthorController::class, 'index']);


