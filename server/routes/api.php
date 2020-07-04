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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/get-menu', 'Dashboard\IndexController@getMenu')->name('get-menu');

// Dashboard
Route::group(['prefix' => 'dashboard', 'namespace' => 'API\Dashboard\\'], function () { // 'middleware' => ['cors']
    // Хостинги
    Route::resource('host', 'Accesses\HostsController');

    // Сайты
    Route::resource('site', 'Accesses\SitesController');

    // Screenshot
    Route::get('srceenshot', 'ScreenshotController@screenshot');
//    Route::get('srceenshot/{site}', 'ScreenshotController@screenshot');

});

//Route::post('/register', 'API\Security\AuthController@register');
//Route::post('/login', 'API\Security\AuthController@login');
//Route::post('/logout', 'API\Security\AuthController@logout');
