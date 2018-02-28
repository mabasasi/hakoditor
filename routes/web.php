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

Auth::routes();

Route::get('/',            'BlogController@index')->name('blog');
//Route::get('/list', 'BlogController@list')->name('list');

Route::get('/blog/{name}', 'BlogController@page')->name('blog.view');



Route::get('/hako-ditor',  'BlogController@dashboard')->middleware('auth')->name('dashboard');

Route::prefix('hako-ditor')->group(function() {

    Route::resource('articles', 'ArticleController');
    Route::resource('tags',     'TagController');

    Route::post('/articles/{article}/handling', 'ArticleHandlingController')->name('articles.handling');

});
