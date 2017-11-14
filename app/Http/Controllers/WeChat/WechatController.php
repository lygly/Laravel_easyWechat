<?php

namespace App\Http\Controllers\WeChat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use League\Flysystem\Config;
use EasyWeChat\Message\News;

class WechatController extends Controller
{
    //
    public function server(){

    // 获取微信配置
   $options = Config('wechat');

    $app = new Application($options);
    // 从项目实例中得到服务端应用实例。
    $server = $app->server;
    //自动回复消息
    $this->message($server);

    $response = $server->serve();
    return $response; // Laravel 里请使用：return $response;

    }
    //自定义菜单
    public function menu(){
        $options = Config('wechat');
        // dd($options);
        $app = new Application($options);
        $menu = $app->menu;
       $buttons = [
           [
               "type" => "click",
               "name" => "歌曲",
               "key"  => "V1001_TODAY_MUSIC"
           ],
           [
               "name"       => "菜单",
               "sub_button" => [
                   [
                       "type" => "view",
                       "name" => "搜索",
                       "url"  => "http://www.soso.com/"
                   ],
                   [
                       "type" => "view",
                       "name" => "视频",
                       "url"  => "http://v.qq.com/"
                   ],
                   [
                       "type" => "click",
                       "name" => "赞一下我们tyhybh",
                       "key" => "V1001_GOOD"
                   ],
               ],
           ],
       ];
     //  $menu->add($buttons);
       $id = '420249046';
       $menu->destroy($id);
    }
    /*
     * 自动回复消息
     * */
    public function message($server){
        $server->setMessageHandler(function ($message) {
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            //自动回复消息
            switch ($message->MsgType) {
                case 'event':
                    // $this->handleEvent($message->Event);
                    switch ($message->Event) {
                        case 'subscribe':

                            $this->menu();
                            return "hello 你来啦";   //关注自动回复
                            break;
                        case 'CLICK':
                            return "点击回复消息";
                            break;
                        default:
                            return '收到事件消息';
                            break;
                    }
                case 'text':
                    return $news = new News([
                        'title'       => '初冬的故宫',
                        'description' => '故宫的银杏',
                        'url'         => 'www.baidu.com',
                        'image'       => 'http://img2.imgtn.bdimg.com/it/u=358455599,2440576095&fm=27&gp=0.jpg',
                        // ...
                    ]);
                    break;
                case 'image':
                    $options = Config('wechat');

                    $app = new Application($options);
                    $notice = $app->notice;
                    $userId = 'okyhUwNdRkU577OWH3XHqbddxBao';
                    $templateId = 'LsJQa_9d0qMfC9MAdCLjzdxM4R9ciqKbrpu50_hYiOs';
                    $url = 'www.baidu.com';
                    $data = array(
                        "first"    => array("恭喜你购买成功！", '#555555'),
                        "name" => array("巧克力", "#336699"),
                        "price" => array("39.8元", "#FF0000"),
                        "remark"   => array("欢迎再次购买！", "#5599FF"),
                    );
                    $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
                    //var_dump($result);
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }

        });
    }
    //微信配置信息
    public function weixin(){
        $options = Config('wechat');
       // dd($options);
        $app = new Application($options);
        $menu = $app->menu;
        $result = $menu->all();
       $id = '420248965';
       // $menu->destroy($id);
        dd($result);
        //模板消息
       /* $notice = $app->notice;
        $userId = 'okyhUwNdRkU577OWH3XHqbddxBao';
        $templateId = 'LsJQa_9d0qMfC9MAdCLjzdxM4R9ciqKbrpu50_hYiOs';
        $url = 'www.baidu.com';
        $data = array(
            "first"    => array("恭喜你购买成功！", '#555555'),
            "name" => array("巧克力", "#336699"),
            "price" => array("39.8元", "#FF0000"),
            "remark"   => array("欢迎再次购买！", "#5599FF"),
        );
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();
        var_dump($result);*/
       //获取用户信息
       /* $openId = 'okyhUwNdRkU577OWH3XHqbddxBao';
        $userService = $app->user;
        $user = $userService->get($openId);
        //dd($user);
        $list = $userService->lists();
       // dd($list);*/

    //永久素材上传
        // 永久素材
       // $material = $app->material;
       // $result = $material->uploadImage(public_path("img/1.jpg"));  // 请使用绝对路径写法！除非你正确的理解了相对路径（好多人是没理解对的）！
       // $mediaId = "aiCCQ3fYDSwwwo02ShV3-tQ2lsv_cm_6wY6e02qBT0I";
        //$result = $material->get($mediaId);
       //  file_put_contents(public_path('img/abc.jpg'),$result);
       // dd($result);
// {
//     'media_id' => string 'aiCCQ3fYDSwwwo02ShV3-tQ2lsv_cm_6wY6e02qBT0I' (length=43)
   //     'url' => string 'http://mmbiz.qpic.cn/mmbiz_jpg/jA6Yvfrib2rPCxQnBlgBibodXvicZpPftjicz1iae0ib1t65Cric22CczZoT6k4I2hujP7llgCNz058OX9ibLbx1jty93g/0?wx_fmt=jpeg' (length=139)
// }
        //删除永久素材
       // $material->delete($mediaId);
        //获取永久素材列表
       // $result = $material->lists('image',0,'10');

       //js_sdk
       // $js = $app->js;
       // return view('wechat.sample',compact('js'));

// ...
    }
    /*
     * 网页授权函数
     * */
    public function oauth_callback(){
        $options = Config('wechat');
        $app = new Application($options);
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session(['wechat_user' => $user->toArray()]);
        $targetUrl = session()->has('target_url') ? session('target_url') : '/';
        header('location:'. $targetUrl); // 跳转到 user/profile
    }
}
