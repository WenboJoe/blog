<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\About;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AboutController extends CommonController
{
    //    get.admin/About 全部关于我列表
    public function index()
    {
//        获取数据
        $data = About::orderBy('about_id','desc') -> paginate(10);
//        显示关于我列表主页
        return view('admin.about.index',compact('data'));
    }

//    get.admin/About/{About}/edit 编辑关于我
    public function edit($about_id)
    {
        $field = About::find($about_id);
        return view('admin.about.edit',compact('field'));
    }

//    put/patch.admin/About/{About} 更新关于我
    public function update($about_id)
    {
//        接收表单数据
        if($input = Input::except('_token','_method'))
        {
//            接收数据成功压入时间戳
            $input['about_time'] = time();
//                添加数据
//                判断添加数据是否成功
            if (About::where('about_id',$about_id) -> update($input))
            {
//                    添加成功
                return redirect('admin/about');
            }
            else{
//                    添加失败
                return back() -> with('errors','修改信息失败，请稍后再试');
            }

        }else{
//            接收数据失败
            return view('admin.about.edit');
        }
    }


}
