<?php

Route::get('/', function () {
    return view('welcome');
});
//商家列表
Route::get('/api/business_list','api\BusinessController@businessList');
//指定商家
Route::get('/api/business','api\BusinessController@business');
//买家注册
Route::post('/api/register','api\BusinessController@register');