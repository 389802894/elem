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