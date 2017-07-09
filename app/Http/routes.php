<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','Home\IndexController@index');
Route::get('/post/{about_id}','Home\IndexController@post');
Route::get('/news/{cate_id}','Home\IndexController@news');
Route::get('/a/{art_id}','Home\IndexController@article');
Route::get('/contact','Home\IndexController@contact');


//后台登陆界面
Route::any('admin/login','Admin\LoginController@login');
//登录界面验证码
Route::get('admin/code','Admin\LoginController@code');

//设置中间件，访问路由时先访问中间件进行判断
Route::group(['middleware' => ['admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function() {
    //主页
    Route::get('/','IndexController@index');
    //info
    Route::get('info','IndexController@info');
    //退出
    Route::get('quit','LoginController@quit');
    //修改密码
    Route::any('pass','IndexController@pass');
    //文章分类异步排序
    Route::post('cate/changeOrder','CategoryController@changeOrder');
    //设置资源路由来实现大量的操作 文章分类
    Route::resource('category','CategoryController');
    //文章
    Route::resource('article','ArticleController');
    //上传图片
    Route::any('upload','CommonController@upload');
    //友情链接
    Route::resource('links','LinksController');
    //友情链接异步排序
    Route::post('links/changeOrder','LinksController@changeOrder');
    //    导航
    Route::resource('navs','NavsController');
    //友情链接异步排序
    Route::post('navs/changeOrder','NavsController@changeOrder');
    //配置项写入配置文件
    Route::get('config/putfile','ConfigController@putFile');
    //    配置项
    Route::resource('config','ConfigController');
    //配置项异步排序
    Route::post('config/changeOrder','ConfigController@changeOrder');
    //index 配置项内容修改
    Route::post('config/changeContent','ConfigController@changeContent');
    //    关于我
    Route::resource('about','AboutController');


});



