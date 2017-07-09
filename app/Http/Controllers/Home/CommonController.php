<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\About;
use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::all();
        //        点击量最高的5篇文章
        $hot = Article::orderBy('art_view','desc') -> take(5) -> get();

//        最新的5篇文章
        $new = Article::orderBy('art_time','desc') -> take(5) -> get();

//        画廊
        $photo = Article::orderBy('art_time','desc') -> take(12) -> get();

//        新闻列表页图 photonews
        $photon = Article::orderBy('art_time','desc') -> take(1) -> get();

//        分类
        $cate = (new category) -> tree();

//        关于我
        $about = About::first();

//        友情链接
        $links = Links::orderBy('link_order','asc') -> get();

        View::share('navs',$navs);
        View::share('hot',$hot);
        View::share('new',$new);
        View::share('photo',$photo);
        View::share('links',$links);
        View::share('photon',$photon);
        View::share('cate',$cate);
        View::share('about',$about);




    }
}
