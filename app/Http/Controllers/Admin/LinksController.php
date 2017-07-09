<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LinksController extends CommonController
{
    //    get.admin/links 全部友情链接列表
    public function index()
    {
        $data = Links::all();
        return view('admin.links.index',compact('data'));
    }

    //    排序
    public function changeOrder()
    {
        $input = Input::all();
//        使用js提交过来的link_id值来查找是那条数据
        $links = Links::find($input['link_id']);
//        改变order值
        $links -> link_order = $input['link_order'];
//        更新
        $re = $links -> update();
//        判断更新正确还是错误
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '友情链接排序更新成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '友情链接更新失败，请稍后重试',
            ];
        }
        return $data;
    }

    //    get.admin/links/{links} 显示单个友情链接信息
    public function show()
    {

    }

    //    get.admin/links/create  添加友情链接
    public function create()
    {
        return view('admin.links.add');
    }

    //    post.admin/store  添加友情链接提交
    public function store()
    {
//        接收表单提交的数据 除了token值
        if ($input = Input::except('_token'))
        {
            $rules = [
                'link_name' => 'required',  //友情链接名称不能为空
                'link_url' => 'required', //友情链接地址不能为空
            ];
            $message = [
                'link_name.required' => '友情链接名称不能为空',
                'link_url.required' => '友情链接地址不能为空',
            ];
//            验证数据合法性
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证成功
//                添加数据
                if ($re = Links::create($input))
                {
//                    添加数据成功 重定向
                    return redirect('admin/links');
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
            return view('admin.links.create');
        }
    }

    //    get.admin/links/{links}/edit 编辑友情链接
    public function edit($link_id)
    {
        $data = Links::find($link_id);

        return view('admin/links/edit',compact('data'));
    }

    //    put/patch.admin/links/{links} 更新友情链接
    public function update($link_id)
    {
    //        接收数据
        if ($input = Input::except('_token','_method'))
        {
//            接收数据成功,验证数据
            $rules = [
                'link_name' => 'required',  //友情链接名称不能为空
                'link_url' => 'required', //友情链接地址不能为
            ];
            $message = [
                'link_name.required' => '友情链接名称不能为空',
                'link_url.required' => '友情链接地址不能为空',
            ];
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证通过,修改数据
                if (Links::where('link_id',$link_id) -> update($input))
                {
//                    修改成功, 重定向网址
                    return redirect('admin/links');
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
            return view('admin/links/edit');
        }
    }

    //    delete.admin/links/{links} 删除单个友情链接
    public function destroy($link_id)
    {
        if (Links::where('link_id',$link_id) -> delete())
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
