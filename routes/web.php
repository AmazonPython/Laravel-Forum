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

// 首页
Route::get('/', function () {
    return view('welcome');
});

// 登录注册及用户验证
Auth::routes(['verify' => true]);

// 语言切换
Route::get('lang/{locale}', 'HomeController')->name('lang');

Route::group(['prefix' => 'threads'], function (){
    // 帖子相关
    Route::get('/', 'ThreadController@index');
    Route::middleware('throttle:3')->post('/', 'ThreadController@store');
    Route::get('/create', 'ThreadController@create');
    Route::get('/{channel}', 'ThreadController@index');
    Route::get('/{channel}/{thread}/edit', 'ThreadController@edit');
    Route::get('/{channel}/{thread}', 'ThreadController@show');
    Route::delete('/{channel}/{thread}', 'ThreadController@destroy');
    Route::patch('/{channel}/{thread}', 'ThreadController@update');

    // 发表回复
    Route::middleware('throttle:10')->post('/{channel}/{thread}/replies', 'ReplyController@store');

    // 通知
    Route::get('/{channel}/{thread}/subscribe', 'ThreadSubscriptionsController@subscribe');
    Route::get('/{channel}/{thread}/unsubscribe', 'ThreadSubscriptionsController@unsubscribe');
});

// 锁帖与解锁
Route::post('/locked/{thread}', 'ThreadController@lock')->middleware('admin');
Route::post('/unlocked/{thread}', 'ThreadController@unlock')->middleware('admin');

Route::group(['prefix' => 'replies'], function (){
    // 回复更新、删除与点赞
    Route::get('/{reply}/edit', 'ReplyController@edit');
    Route::patch('/{reply}', 'ReplyController@update');
    Route::delete('/{reply}', 'ReplyController@destroy');
    Route::post('/{reply}/best', 'ReplyController@bestReply')->name('bestReply');
    Route::post('/{reply}/favorites', 'FavoriteController@store');
    Route::delete('/{reply}/favorites', 'FavoriteController@destroy');
});

Route::group(['prefix' => 'profiles'], function (){
    // 用户页
    Route::get('/{user}', 'ProfileController@show')->name('profile');
    Route::get('/{user}/notifications', 'ProfileController@all');
    Route::get('/{user}/notifications/{notification}', 'ProfileController@read');
    Route::post('/{user}/avatar', 'ProfileController@avatar')->name('avatar');
});

// 用户搜索
Route::get('search', 'SearchController@show')->name('user.search');
