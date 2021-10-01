<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
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
Route::get('/posts/show/{post}', [PostController::class, 'show']);

Route::view('/posts/create', 'posts.create')->middleware('auth');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth');

// Login/Register routes
Route::view('/login', 'users.login')->name('login');
Route::view('/register', 'users.register')->name('register');

Route::post('/login', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'store']);