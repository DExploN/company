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
Route::prefix(LaravelLocalization::setLocale())
    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        Route::get('/', 'SiteController@index')->name('index');
        Route::get('/portfolio', 'SiteController@portfolio')->name('portfolio.index');

        Route::prefix('/admin')->group(function () {
            Auth::routes([
                'register' => false,
                'reset' => false,
                'verify' => false,
            ]);

            Route::middleware('auth')->name('admin.')->group(function () {
                Route::resource('portfolio', 'Admin\PortfolioController')->except(['show']);
                Route::put('/portfolio/{portfolio}/update-lang', 'Admin\PortfolioController@updateLang')->name('portfolio.update-lang');
                Route::delete('/portfolio/{portfolio}/destroy-lang', 'Admin\PortfolioController@destroyLang')->name('portfolio.destroy-lang');
            });


        });
    });
