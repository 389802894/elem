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
//导航菜单资源路由
Route::resource('navs','NavController');
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
//会员管理
Route::resource('members','MemberController');
//权限资源路由
Route::resource('roles','RoleController');
//角色资源路由
Route::resource('permissions','PermissionController');

////发送邮箱
//Route::post('/mails','MailsController@mail')->name('mails.mail');

//发送邮箱审核资源路由
Route::resource('mails','MailController');
//Route::get('mails','MailController@update')->name('mails');

//抽奖活动资源路由
Route::resource('events','EventController');
//报名人查看
Route::resource('event_members','EventMemberController');
//奖品资源路由
Route::resource('event_prizes','EventPrizeController');

