<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
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

// Post routes
Route::get('/', [PostController::class, 'index']);

Route::group(['prefix' => '/posts', 'middleware' => ['auth']], function () {
    Route::get('/show/{post}', [PostController::class, 'show'])->withoutMiddleware('auth');
    Route::delete('/destroy/{id}', [PostController::class, 'destroy']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::get('/edit/{post}', [PostController::class, 'edit']);
    Route::post('/store', [PostController::class, 'store']);
    Route::view('/create', 'posts.create');
});

// Login/Register routes
Route::view('/login', 'users.login')->name('login');
Route::view('/register', 'users.register')->name('register');

Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'store']);