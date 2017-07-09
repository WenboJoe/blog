<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //    get.admin/navs 全部导航列表
    public function index()
    {
        $data = Navs::orderBy('nav_order','asc') -> get();
        return view('admin.navs.index',compact('data'));
    }

    //    排序
    public function changeOrder()
    {
        $input = Input::all();
//        使用js提交过来的link_id值来查找是那条数据
        $navs = Navs::find($input['nav_id']);
//        改变order值
        $navs -> nav_order = $input['nav_order'];
//        更新
        $re = $navs -> update();
//        判断更新正确还是错误
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '导航排序更新成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '导航更新失败，请稍后重试',
            ];
        }
        return $data;
    }

    //    get.admin/navs/{navs} 显示单个导航信息
    public function show()
    {

    }

    //    get.admin/navs/create  添加导航
    public function create()
    {
        return view('admin.navs.add');
    }

    //    post.admin/store  添加导航提交
    public function store()
    {
//        接收表单提交的数据 除了token值
        if ($input = Input::except('_token'))
        {
            $rules = [
                'nav_name' => 'required',  //导航名称不能为空
                'nav_url' => 'required', //导航地址不能为空
            ];
            $message = [
                'nav_name.required' => '导航名称不能为空',
                'nav_url.required' => '导航地址不能为空',
            ];
//            验证数据合法性
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证成功
//                添加数据
                if ($re = navs::create($input))
                {
//                    添加数据成功 重定向
                    return redirect('admin/navs');
                }else{
//                    添加数据失败
                    return back() -> with('errors','添加数据失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin.navs.create');
        }
    }

    //    get.admin/navs/{navs}/edit 编辑导航
    public function edit($nav_id)
    {
        $data = Navs::find($nav_id);

        return view('admin/navs/edit',compact('data'));
    }

    //    put/patch.admin/navs/{navs} 更新导航
    public function update($nav_id)
    {
        //        接收数据
        if ($input = Input::except('_token','_method'))
        {
//            接收数据成功,验证数据
            $rules = [
                'nav_name' => 'required',  //导航名称不能为空
                'nav_url' => 'required', //导航地址不能为
            ];
            $message = [
                'nav_name.required' => '导航名称不能为空',
                'nav_url.required' => '导航不能为空',
            ];
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证通过,修改数据
                if (Navs::where('nav_id',$nav_id) -> update($input))
                {
//                    修改成功, 重定向网址
                    return redirect('admin/navs');
                }else{
//                    修改失败，提示错误
                    return back() -> with('errors','修改数据失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin/navs/edit');
        }
    }

    //    delete.admin/navs/{navs} 删除单个导航
    public function destroy($nav_id)
    {
        if (Navs::where('nav_id',$nav_id) -> delete())
        {
//            删除成功
            $data = [
                'status' => 0,
                'msg' => '删除友情链接成功',
            ];
        }else{
//            删除失败
            $data = [
                'status' => 1,
                'msg' => '删除友情链接失败',
            ];
        }
        return $data;
    }


}
