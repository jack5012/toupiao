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
Route::any('/wechat', 'WeChatController@serve');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user');
        dd($user);
    });
});

Route::group(['middleware' => ['web', 'wechat.oauth:snsapi_userinfo']], function () {

});

Route::get('vote-project/{id}', 'VoteProjectsController@index');
Route::get('vote-project/{id}/ranking', 'VoteProjectsController@ranking');
Route::any('vote-project/{id}/search', 'VoteProjectsController@search');
Route::any('vote-project/{id}/register', 'VoteProjectsController@register');

Route::get('vote-item', 'VoteItemsController@index');
Route::get('vote-item/{id}', 'VoteItemsController@show');
Route::post('vote-item/{id}/vote', 'VoteItemsController@vote');