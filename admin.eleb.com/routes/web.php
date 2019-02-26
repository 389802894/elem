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
//商家分类
Route::resource('shopCategories','ShopCategoryController');
//商家
Route::resource('shops','ShopController');
//商家账户资源路由
Route::resource('shopUsers','ShopUserController');
//商家重置密码
Route::patch('shopUsers/{shopUser}/reset','ShopUserController@reset')->name('shopUsers.reset');

//管理员
Route::resource('admins','AdminController');
//管理员登录
Route::get('login','SignInController@create')->name('login');
Route::post('login','SignInController@store')->name('login');
//注销
Route::get('destroy','SignInController@destroy')->name('destroy');
//活动资源路由
Route::resource('activities','ActivityController');
//文件上传
Route::post('/upload','ShopCategoryController@upload')->name('upload');