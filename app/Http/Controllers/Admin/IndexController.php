<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }
    //修改密码
    public function pass()
    {
        if ($input = Input::all()) {
            $rules = [
                'password' => 'required|between:6,20|confirmed',//新密码不可为空|在6，20|再次输入密码是否一致
            ];
            $message = [
                'password.required' => '新密码不可为空！',
                'password.between' => '新密码长度为6-20位！',
                'password.confirmed' => '新密码和确认密码不一致！',
            ];
            //验证:密码 新密码 确认密码
            $validator = Validator::make($input, $rules, $message);
            if ($validator->passes()) {
//                验证通过
                $user = User::first();
                $_password = Crypt::decrypt($user -> user_pass);
                //判断用户输入旧密码和数据库是否一致
                if ($input['password_o'] == $_password)
                {   //一致，则把新密码加密后存入数据库
                    $user -> user_pass = Crypt::encrypt($input['password']);
                    $user -> update();
                    return back() -> with('errors','密码修改成功！');
                }else{
//                    验证失败
                    return back() -> with('errors','原密码错误！');
                    //return back() -> withErrors('原密码错误！');
                }
            } else {
                return back() -> withErrors($validator);
            }
        }else {
            return view('admin.pass');
        }
    }
}
