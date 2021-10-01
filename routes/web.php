<?php

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

// show login form
Route::match(['get', 'post'], '/login', [App\Http\Controllers\UserController::class, 'login']);
Route::match(['get', 'post'], '/register', [App\Http\Controllers\UserController::class, 'register']);
Route::get('/', [App\Http\Controllers\UserController::class, 'dashboard']);
Route::post('search-value', [App\Http\Controllers\UserController::class, 'searchValue']);
Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout']);

// get all users
Route::get('users', [App\Http\Controllers\UserController::class, 'getAllUsers'])->name('all-users');
Route::post('delete-user', [App\Http\Controllers\UserController::class, 'deleteUser']);

