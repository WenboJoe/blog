@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 关于我管理
    </div>
    <!--面包屑导航 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_title">
                <h3>关于我列表</h3>
            </div>
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/about')}}"><i class="fa fa-recycle"></i>全部关于我</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>
                        <th class="tc">ID</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>点击</th>
                        <th>发布时间</th>
                        <th>联系方式</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <td class="tc">{{$v -> about_id}}</td>
                        <td>
                            <a href="#">{{$v -> about_title}}</a>
                        </td>
                        <td>
                            <a href="#">{{$v -> about_author}}</a>
                        </td>
                        <td>{{$v -> about_view}}</td>
                        <td>{{date('Y-m-d',$v -> about_time)}}</td>
                        <td>
                            <a href="#">{{$v -> about_email}}</a>
                        </td>
                        <td>
                            <a href="{{url('admin/about/'.$v -> about_id.'/edit')}}">修改</a>
                            {{--<a href="javascript:;" onclick="delArt({{$v -> about_id}})">删除</a>--}}
                        </td>
                    </tr>
                    @endforeach
                </table>

                {{--<div class="page_list">--}}
                    {{--{{$data -> links()}}--}}
                {{--</div>--}}
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
    <style>
        .result_content ul li span{
            font-size: 15px;
            padding: 6px 12px;
        }
        .page_list {
            text-align: center;
        }
    </style>
    {{--<script>--}}
{{--//        删除关于我--}}
        {{--function delArt(about_id)--}}
        {{--{--}}
{{--//            询问框--}}
            {{--layer.confirm('您确定删除这篇关于我吗?',{--}}
                {{--btn: ['确定','取消'] //按钮--}}
            {{--},function(){--}}
{{--//                异步处理--}}
                {{--$.post("{{url('admin/article/')}}/"+about_id,{'_method':'delete','_token':"{{csrf_token()}}"},function(data){--}}
                   {{--if(data.status == 0)--}}
                   {{--{--}}
{{--//                       删除成功--}}
                       {{--location.href = location.href;--}}
                       {{--layer.msg(data.msg, {icon: 6});--}}
                   {{--}else{--}}
{{--//                       删除失败--}}
                       {{--layer.msg(data.msg, {icon: 5});--}}
                   {{--}--}}
                {{--});--}}
{{--//                layer.msg('的确很重要', {icon: 1});--}}
            {{--},function(){--}}

            {{--});--}}
        {{--}--}}
    {{--</script>--}}
@endsection