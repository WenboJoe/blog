<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\IpUtils;

class CommonController extends Controller
{
    //公共控制器。
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');
        if ($file -> isValid())
        {
            $entension = $file -> getClientOriginalExtension();//上传文件的后缀.
            $newName = date('YmdHis') . mt_rand(100,999) . '.' . $entension;//为了保证文件的唯一性
            $path = $file -> move(base_path() . '/uploads',$newName);//文件存储路径
//            返回json格式文件
            $filepath = 'uploads/' . $newName; //拼接处需要返回的文件路径
            return $filepath;
        }
    }
}
