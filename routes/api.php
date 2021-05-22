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
// authentication
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'APIController@login');
    Route::post('logout', 'APIController@logout');
    Route::post('refresh', 'APIController@refresh');
    Route::post('me', 'APIController@me');

});

// get all user inputs
Route::group([
    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'values'
], function ($router) {
    Route::get('get-all-values/{id}', 'APIController@getAllInputValues');
});
