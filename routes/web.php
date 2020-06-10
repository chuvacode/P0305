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

// Авторизация
Route::get('/', 'IndexController@index')->name('login');
Route::get('/login', 'IndexController@index')->name('login');

// Dashboard
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function () {
    Route::get('/', 'IndexController@host')->name('dashboard');

    Route::get('/host', 'IndexController@host')->name('host');
    Route::get('/site', 'IndexController@site')->name('site');
    Route::get('/other', 'IndexController@other')->name('other');
    Route::get('/report', 'IndexController@report')->name('report');
});


//
//Auth::routes();
//Route::get('/home', 'IndexController@index')->name('home');
//



//Route::get('/home', '');

//php artisan ui vue --auth

//Auth::routes();
//
//Route::get('/home', 'IndexController@index')->name('home');


