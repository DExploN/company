<?php

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

Route::get('/', 'SiteController@index')->name('index');
Route::get('/portfolio', 'SiteController@portfolio')->name('portfolio.show');

Route::prefix('/admin')->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::middleware('auth')->group(function () {
        Route::resource('portfolio', 'Admin\PortfolioController')->except(['show']);
    });
});
