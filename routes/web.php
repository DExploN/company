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

            Route::middleware('auth')->name('admin.')->namespace('Admin')->group(function () {
                Route::resource('page', 'PageController')->except(['show']);
                Route::put('/page/{page}/update-lang', 'PageController@updateLang')->name('page.update-lang');
                Route::delete('/page/{page}/destroy-lang', 'pageController@destroyLang')->name('page.destroy-lang');

                Route::resource('portfolio', 'PortfolioController')->except(['show']);
                Route::put('/portfolio/{portfolio}/update-lang', 'PortfolioController@updateLang')->name('portfolio.update-lang');
                Route::delete('/portfolio/{portfolio}/destroy-lang', 'PortfolioController@destroyLang')->name('portfolio.destroy-lang');
            });


        });

        Route::group(['middleware' => 'auth', 'prefix' => 'filemanager'], function () { // auth middleware is important!
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        Route::get('/{page}', 'SiteController@page')->where('page', '[a-z\-0-9_]+')->name('page.show');
    });



