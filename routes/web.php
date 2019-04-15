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
//微信
Route::get('valid','wei\WeiController@valid');
Route::any('valid','wei\WeiController@wxEvent');
//获取token
Route::get('toke','wei\WeiController@toke');
