<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;


class WechatController extends Controller
{
    //
    public function server(){

    // ...
    $options = [
        'debug'  => true,
        'app_id' => 'wx2fb8f9fd418d80c5',
        'secret' => '416b11926695931ee5b2b23e2766838b',
        'token'  => 'easywechat',
        // 'aes_key' => null, // 可选
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
        ],
        //...
    ];
    $app = new Application($options);
    // 从项目实例中得到服务端应用实例。
    $server = $app->server;
    $server->setMessageHandler(function ($message) {
        // $message->FromUserName // 用户的 openid
        // $message->MsgType // 消息类型：event, text....
        return "您好！欢迎关注我!";
    });
    $response = $server->serve();
    return $response; // Laravel 里请使用：return $response;

    }
}
