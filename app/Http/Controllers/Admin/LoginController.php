<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    //
    public function login(){
        if($input = Input::get()){
            $code = new \Code();
             $codes = $code->get();
             if(strtoupper($input['userCode'])!= $codes){
                 //   return back()->withInput()->withErrors('验证码错误！');
               return $response=['status'=>0,'msg'=>'验证码错误'];
             }


             $user = User::first();
             if($user->user_name!=$input['userName']){
                 //return back()->withInput()->withErrors('用户名错误！');
                return $response = ['status'=>0,'msg'=>'用户名错误'];
             }elseif($user->user_pass!=$input['userPass']){
                 //return back()->withInput()->withErrors('密码错误！');
               return  $response = ['status'=>0,'msg'=>'密码错误'];
             }else{
                 session(['user'=>$user]);
                 //return redirect('admin');
              return   $response=['status'=>1,'msg'=>'登录成功'];
             }
             //return  $response;
        }else{
            return view('admin.login');
        }

    }
    //验证码
    public function code(){
        $code=new \Code();//实例化
        $code->make(); //创建验证码
        /*
         *
         * if ($poll->save()) {

        return response()->json(array(

            'status' => 1

            'msg' => 'ok',

        ));

    } else {

        return Redirect::back()->withInput()->withErrors('保存失败！');

    }

         * */
    }
    /*
     * 退出系统
     * */
    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
