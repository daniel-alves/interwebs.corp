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

Route::get('/', function () {
    return redirect("/webpages") ;
})->middleware('auth');

Auth::routes();

Route::get('webpages/reload', 'WebPageController@reload')->name('webpages.reload');
Route::get('webpages/{id}/content', 'WebPageController@content')->name('webpages.content');

Route::resource('webpages', 'WebPageController');


