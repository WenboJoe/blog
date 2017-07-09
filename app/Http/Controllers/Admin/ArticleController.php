<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    //    get.admin/article 全部文章列表
    public function index()
    {
//        获取数据
        $data = Article::orderBy('art_id','desc') -> paginate(10);
//        显示文章列表主页
        return view('admin.article.index',compact('data'));
    }

    //    get.admin/article/create  添加文章
    public function create()
    {
        $data = (new category) -> tree();
        //显示添加文章页面
        return view('admin.article.add',compact('data'));
    }

    //    post.admin/article  添加文章提交
    public function store()
    {
//        接收数据
        if ($input = Input::except('_token')) {
//            接收数据成功 压入时间戳
            $input['art_time'] = time();
//          验证数据
//          规则
            $rules = [
//                文章标题
                'art_title' => 'required',
//                文章内容
                'art_content' => 'required',
            ];
//          错误信息
            $message = [
                'art_title.required' => '文章标题不能为空!',
                'art_content.required' => '文章内容不能为空!',
            ];
//          使用validator来验证数据
            $validator = Validator::make($input, $rules, $message);
//          判断验证
            if ($validator->passes()) {
//              验证成功
//              添加数据
                $re = Article::create($input);
//              判断是否添加数据成功
                if ($re) {
//                  成功
                    return redirect('admin/article');
                } else {
//                  失败
                    return back()->with('errors', '数据填充失败，请稍后再试');
                }
            } else {
//              验证失败 返回错误信息
                return back()->withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin.article.create');
        }

    }

//    get.admin/article/{article}/edit 编辑文章
    public function edit($art_id)
    {
        $field = Article::find($art_id);
        $data = (new category) -> tree();
        return view('admin.article.edit',compact('field','data'));
    }

//    put/patch.admin/article/{article} 更新文章
    public function update($art_id)
    {
//        接收表单数据
        if($input = Input::except('_token','_method'))
        {
//            接收数据成功压入时间戳
            $input['art_time'] = time();
//            接收数据成功，开始验证
//            验证规则
            $rules = [
//                文章标题
                'art_title' => 'required',
//                文章内容
                'art_content' => 'required',
            ];
//            错误信息
            $message = [
                'art_title.required' => '文章标题不能为空!',
                'art_content.required' => '文章内容不能为空!',
            ];
            $validator = Validator::make($input,$rules,$message);
//            判断验证
            if ($validator -> passes())
            {
//                验证成功
//                添加数据
//                判断添加数据是否成功
                if (Article::where('art_id',$art_id) -> update($input))
                {
//                    添加成功
                    return redirect('admin/article');
                }else{
//                    添加失败
                    return back() -> with('errors','修改信息失败，请稍后再试');
                }
            }else{
                //验证失败
                return back() -> withErrors($validator);
            }
        }else{
//            接收数据失败
            return view('admin.article.edit');
        }
    }

//    delete.admin/article/{article} 删除文章
    public function destroy($art_id)
    {
        if (Article::where('art_id',$art_id) -> delete())
        {
//            删除成功
            $data = [
                'status' => 0,
                'msg' => '文章删除成功 !',
            ];
        }else{
//            删除失败
            $data = [
                'status' => 1,
                'msg' => '分类删除失败，请稍后重试！',
            ];
        }
        return $data;
    }


}
