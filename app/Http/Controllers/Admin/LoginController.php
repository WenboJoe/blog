<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once "resources/org/code/Code.class.php";
class LoginController extends CommonController
{
    //显示登陆界面
    public function login()
    {
        //接收表单传来的数据做判断
        if ($input = Input::all())
        {
            //如果接收到数据则先验证验证码
            //实例化验证码类
            $code = new \Code();
            $_code = $code -> get();//获取验证码
            //判断用户输入验证码和电脑生成验证码是否一致
            if (strtoupper($input['code']) != $_code)
            {
                //不一致返回错误信息
                return back()->with('msg', '验证码错误');
            }
            //获取记录
            $user=User::first();
            //判断用户输入的信息和数据库中数据是否一致
            if ($user -> user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass'])
            {   //不一致返回错误信息
                return back()->with('msg', '用户名或密码错误');
            }
            //一致则把用户信息存入session
            session(['user'=>$user]);
            return redirect('admin');//跳转到首页
        }else{
            return view('admin.login');//没有数据 显示登陆界面
        }

    }
    //登陆界面验证码
    public function code()
    {
        $code = new \Code();
        $code -> make();
    }
    //退出登陆清除session
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }


}
