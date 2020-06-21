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

// Главная
Route::get('/', 'AppController@run')->name('home');

//// Приборная панель
//Route::group(['prefix' => 'dashboard'], function () {
//
//    // Главная
//    Route::get('/', 'AppController@run')->name('dashboard');
//
//    // Хостинги
//    Route::get('/host', 'AppController@run')->name('dashboard.host');
//    Route::get('/host/show/{host}', 'AppController@run')->name('dashboard.host.show');
//    Route::get('/host/edit/{host}', 'AppController@run')->name('dashboard.host.edit');
//
//    // Сайты
//    Route::get('/site', 'AppController@run')->name('dashboard.site');
//
//    // Сайты
//    Route::get('/other', 'AppController@run')->name('dashboard.other');
//
//    // Сайты
//    Route::get('/report', 'AppController@run')->name('dashboard.report');
//
//});




//
//Route::get('/login', 'IndexController@index')->name('login');




//
//Auth::routes();
//Route::get('/home', 'IndexController@index')->name('home');
//



//Route::get('/home', '');

//php artisan ui vue --auth

//Auth::routes();
//
//Route::get('/home', 'IndexController@index')->name('home');


