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

        }
    }
}
