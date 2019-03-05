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
Route::patch('update','SignInController@update')->name('update');
//菜品分类资源路由
Route::resource('menuCategories','MenuCategoryController');
//菜品资源路由
Route::resource('menus','MenuController');
//搜索
Route::get('search','MenuCategoryController@search')->name('search');
//平台活动
Route::resource('activities','ActivityController');
//订单管理资源路由
Route::resource('orders','OrderController');
//最近一周订单量统计
Route::get('tongji_week','TongjiController@week')->name('tongji_week');
//最近三个月订单量统计
Route::get('tongji_month','TongjiController@month')->name('tongji_month');



