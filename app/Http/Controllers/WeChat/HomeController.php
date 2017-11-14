<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Config;
use EasyWeChat\Foundation\Application;
class HomeController extends Controller
{
    //微信首页
    public function Index(){
        $options = Config('wechat');
        $app = new  Application($options);
        //网页授权
        $oauth = $app->oauth;
        // 未登录
        if (!session()->has('wechat_user')) {
            session(['target_url'=>'wechat/user/profile']);
            return $oauth->redirect();
                // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
                // $oauth->redirect()->send();
            }
      // 已经登录过
            $user = session('wechat_user');
            dd(session('wechat_user'));
    }
}
