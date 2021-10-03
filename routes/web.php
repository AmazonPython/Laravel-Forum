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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('lang/{locale}', 'HomeController@lang')->name('lang');

Route::get('/threads', 'ThreadController@index');
Route::middleware('throttle:3')->post('/threads', 'ThreadController@store');
Route::get('/threads/create', 'ThreadController@create');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy');

Route::middleware('throttle:10')->post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::patch('/replies/{reply}', 'ReplyController@update');
Route::delete('/replies/{reply}', 'ReplyController@destroy');

Route::post('/replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('/replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/threads/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@subscribe');
Route::get('/threads/{channel}/{thread}/unsubscribe', 'ThreadSubscriptionsController@unsubscribe');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');
Route::get('/profiles/{user}/notifications', 'ProfileController@all');
Route::get('/profiles/{user}/notifications/{notification}', 'ProfileController@read');

Route::get('search', 'ProfileController@search')->name('user.search');
