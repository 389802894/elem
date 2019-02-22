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
//商家资源路由
Route::resource('shopUsers','ShopUserController');
//商家登陆
Route::get('login','SignInController@create')->name('login');
Route::post('login','SignInController@store')->name('login');
//注销
Route::get('destroy','SignInController@destroy')->name('destroy');
//修改密码
Route::get('modify','SignInController@modify')->name('modify');
Route::post('update','SignInController@update')->name('update');
