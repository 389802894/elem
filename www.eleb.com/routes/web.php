<?php

Route::get('/', function () {
    return view('welcome');
});
//商家列表
Route::get('/api/business_list','api\BusinessController@businessList');
//指定商家
Route::get('/api/business','api\BusinessController@business');
//买家注册
Route::post('/api/regist','api\BusinessController@regist');
//买家登录
Route::post('/api/loginCheck','api\BusinessController@loginCheck');
//短信验证码
Route::get('/api/sms','api\BusinessController@sms');
//收货地址列表
Route::get('/api/address_list','api\BusinessController@addressList');
//添加收货地址
Route::post('/api/add_address','api\BusinessController@addAddress');
//修改回显收货地址
Route::get('/api/address','api\BusinessController@address');
//保存修改收货地址
Route::post('/api/edit_address','api\BusinessController@editAddress');
//保存购物车
Route::post('/api/add_cart','api\BusinessController@addCart');
//获取购物车
Route::get('/api/cart','api\BusinessController@cart');
//添加订单
Route::post('/api/add_order','api\BusinessController@addOrder');
//获得指定订单接口
Route::get('/api/order','api\BusinessController@order');

//修改密码
Route::post('/api/changePassword','api\BusinessController@changePassword');
//修改密码
Route::post('/api/forgetPassword','api\BusinessController@forgetPassword');