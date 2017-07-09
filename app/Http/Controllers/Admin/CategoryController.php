<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
//    get.admin/category 全部分类列表
    public function index()
    {
        $data = (new Category) -> tree();
       // $data = $model ->getTree();

        return view('admin.category.index') -> with('data',$data);
    }
//    排序
    public function changeOrder()
    {
        $input = Input::all();
//        使用js提交过来的cate_id值来查找是那条数据
        $cate = Category::find($input['cate_id']);
//        改变order值
        $cate -> cate_order = $input['cate_order'];
//        更新
        $re = $cate -> update();
//        判断更新正确还是错误
        if ($re){
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败，请稍后重试',
            ];
        }
        return $data;
    }
//    get.admin/category/create  添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0) -> get();

//        return view('admin/category/add') -> with('data',$data);
        return view('admin/category/add',compact('data'));
    }
//    post.admin/store  添加分类提交
    public function store()
    {
//        接收表单提交的数据
        if ($input = Input::except('_token'))
        {
            $rules = [
                'cate_name' => 'required',//分类名称不能为空
            ];
            $message = [
                'cate_name.required' => '分类名称不能为空',
            ];
//          验证数据
            $validator = Validator::make($input,$rules,$message);
            if ($validator->passes())
            {
//                验证通过
//                添加数据
                if($re = Category::create($input))
                {
//                    添加数据成功，重定向到列表
                    return redirect('admin/category');
                }else{
//                    添加数据失败
                    return back() -> with('errors','添加数据失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            没有数据
            return view('admin.category.create');
        }

    }
//    get.admin/category/{category} 显示单个分类信息
    public function show()
    {

    }
//    delete.admin/category/{category} 删除单个分类
    public function destroy($cate_id)
    {
        if(Category::where('cate_id',$cate_id) -> delete()){
            Category::where('cate_pid',$cate_id) -> update(['cate_pid' => 0]);
//            删除成功
            $data = [
                'status' => 0,
                'msg' => '分类删除成功！',
            ];
        }else{
//            删除失败
            $data = [
                'status' => 1,
                'msg' => '分类删除失败,请稍后重试！',
            ];
        }
        return $data;
    }
//    put/patch.admin/category/{category} 更新分类
    public function update($cate_id)
    {
//        接收表单数据
        if($input = Input::except('_token','_method'))
        {
//            接收数据成功，定义验证信息
            $rules = [
                'cate_name' => 'required',
            ];
            $message = [
                'cate_name.required' => '分类名称不能为空',
            ];
            $validator = Validator::make($input,$rules,$message);
            if ($validator -> passes())
            {
//                验证通过
                if(Category::where('cate_id',$cate_id) -> update($input))
                {
//                更新成功
                    return redirect('admin/category');
                }else{
//                更新失败
                    return back() -> with('errors','更新失败，请稍后再试');
                }
            }else{
//                验证失败
                return back() -> withErrors($validator);
            }
        }else{
            return redirect('admin/category/edit');
        }
    }
//    get.admin/category/{category}/edit 编辑分类
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);

//        获取父级id
        $data = Category::where('cate_pid',0) -> get();
        return view('admin/category/edit',compact('field','data'));
    }
}
