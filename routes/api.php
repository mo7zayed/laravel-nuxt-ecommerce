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

Route::post('login', 'Auth\AuthController@login');
Route::post('register', 'Auth\AuthController@register');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    // JWT auth uri's
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
});

Route::resource('categories', 'Categories\CategoriesController');
Route::resource('products', 'Products\ProductsController');
