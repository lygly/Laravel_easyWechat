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
    Route::any('weixin','WechatController@weixin');//连接微信和基础配置
    Route::any('oauth_callback','WechatController@oauth_callback');//网页授权

});
//后台登录路由
Route::any('admin/login','Admin\LoginController@login');//后台登录
Route::get('admin/code','Admin\LoginController@code');//后台验证码


Route::group(['middleware'=>'admin.login','prefix'=>'admin','namespace'=>'admin'],function (){
    Route::get('/','IndexController@index');//后台首页
    Route::get('main','IndexController@main');
    Route::get('quit','LoginController@quit');//退出系统
});