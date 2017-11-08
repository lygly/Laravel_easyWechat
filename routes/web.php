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
//微信路由
//Route::any('wechat/server','WechatController@server');
Route::group(['middleware'=>'csrf.ignore','prefix'=>'wechat','namespace'=>'WeChat'],function (){
    Route::any('wechat','WechatController@server');//连接微信和基础配置
});
