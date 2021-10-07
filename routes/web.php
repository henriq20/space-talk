<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Models\User;
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
Route::resource('posts', PostController::class)->except('index');

// Login/Register routes
Route::view('/login', 'users.login')->name('login');
Route::view('/register', 'users.register')->name('register');

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);

// User routes
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function () {
    Route::get('/{username}', [UserController::class, 'profile'])->withoutMiddleware('auth');
    Route::get('/{username}/edit', [UserController::class, 'edit']);
    Route::post('/{username}', [UserController::class, 'update']);
});