<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\About;
use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;


class IndexController extends CommonController
{
//    前台首页
    public function index()
    {
//        图文列表
//        $data = Article::orderBy('art_time','desc') -> paginate(1);
        $data = Article::Join('category','article.cate_id','=','category.cate_id') -> paginate(3);

        return view('home.index',compact('data'));
    }

    //    新闻
    public function news($cate_id)
    {

        $category = Category::find($cate_id);

//        查看次数 自增
        Category::where('cate_id',$cate_id) -> increment('cate_view');

        //        新闻列表页
        $newsList = Article::where('cate_id',$cate_id) -> orderBy('art_time','desc') -> paginate(2);
        //新闻分类
        $submenu = Category::where('cate_pid',$cate_id) -> get();
        return view('home.newsList',compact('category','newsList','submenu'));
    }

//    文章详情页 particulars
    public function article($art_id)
    {
        $article = Article::Join('category','article.cate_id','=','category.cate_id') -> where('art_id',$art_id) -> first();

//        查看次数 自增
        Article::where('art_id',$art_id) -> increment('art_view');

//        上一篇 下一篇
        $field['pre'] = Article::where('art_id','<',$art_id) -> orderBy('art_id','desc') -> first();
        $field['next'] = Article::where('art_id','>',$art_id) -> orderBy('art_id','asc') -> first();
//        相关文章
        $data = Article::where('cate_id',$article -> cate_id) -> orderBy('art_id','desc') -> take(6) -> get();

        return view('home.particulars',compact('article','field','data'));
    }

    //    关于我
    public function post($about_id)
    {
        About::where('about_id',$about_id) -> increment('about_view');
        return view('home.post');
    }
    //    联系我
    public function contact()
    {
        $email = About::first();
        $nav = Navs::first();
        return view('home.contact',compact('email','nav'));
    }

}
