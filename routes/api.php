<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/ping', function(){
    return ['pong' => true];
});


// Route::get('/unauthorized','AuthController@unauthorized')->name('login');

// Route::post('/auth/login',[AuthController::class, 'login']);
// Route::post('/auth/logout','AuthController@logout');
// Route::post('/auth/refresh','AuthController@refresh');

Route::post('/user', [AuthController::class, 'create']);
// Route::put('/user', 'UserController@update');
// Route::post('/user/avatar', 'UserController@updateAvatar');
// Route::post('/user/cover', 'UserController@updateCover');

// Route::get('/feed','FeedController@read');
// Route::get('/user/feed','FeedController@userFeed');
// Route::get('/user/{id}/feed','FeedController@userFeed');

// Route::get('/user','UserController@read');
// Route::get('/user/{id}','UserController@read');

// Route::post('/feed','FeedController@create');

// Route::post('/post/{id}/like','PostController@like');
// Route::post('/post/{id}/comment','PostController@comment');

// Route::get('/search', 'SearchController@search');

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
