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

//Route::get('/dashboard/host/export', 'API\Dashboard\Accesses\HostsController@export');

Route::get('/dashboard/host/export-link', 'API\Dashboard\Accesses\ExportController@export')->name('all-export');

Route::middleware('auth:api')->group(function () {
    // Auth
    Route::post('/logout', 'API\Security\AuthController@logout');
    Route::get('/get-user', 'API\Security\AuthController@getUser');
//    Route::get('/check-auth', 'API\Security\AuthController@checkAuth');

    Route::get('/get-menu', 'Dashboard\IndexController@getMenu')->name('get-menu');

    // Dashboard
    Route::group(['prefix' => 'dashboard', 'namespace' => 'API\Dashboard\\'], function () { // 'middleware' => ['cors']
        // Хостинги

        Route::get('host/export', 'Accesses\ExportController@getDownloadExport');
        Route::resource('host', 'Accesses\HostsController');

        // Сайты
        Route::resource('site', 'Accesses\SitesController');

        // Сайты
        Route::resource('other', 'Accesses\OthersController');

        // Сотрудники
        Route::resource('personal', 'Account\UserController');

        // Screenshot
        Route::get('srceenshot', 'ScreenshotController@screenshot');
    //    Route::get('srceenshot/{site}', 'ScreenshotController@screenshot');

    });
});

// Auth
Route::post('/register', 'API\Security\AuthController@register');
Route::post('/login', 'API\Security\AuthController@login');
Route::post('/login', 'API\Security\AuthController@login');
Route::get('/user', 'API\Security\AuthController@index');






