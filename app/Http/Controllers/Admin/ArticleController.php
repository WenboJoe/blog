<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\CommonController;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends CommonController
{
    //    get.admin/article 全部文章列表
    public function index()
    {
        echo '哈哈';
    }

    //    get.admin/article/create  添加分类
    public function create()
    {
        $data = (new category) -> tree();
        //显示添加文章页面
        return view('admin.article.add',compact('data'));
    }

    //    post.admin/store  添加分类提交
    public function store()
    {

    }
}
