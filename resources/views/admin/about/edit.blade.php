@extends('layouts/admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; about管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑about</h3>
            @if(count($errors) > 0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors -> all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                {{--<a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>添加about</a>--}}
                <a href="{{url('admin/about')}}"><i class="fa fa-recycle"></i>全部about</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/about/' . $field -> about_id)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th>About标题：</th>
                        <td>
                            <input type="text" class="lg" name="about_title" value="{{$field -> about_title}}">
                        </td>
                    </tr>
                    <tr>
                        <th>作者：</th>
                        <td>
                            <input type="text" class="lg" name="about_author" value="{{$field -> about_author}}">
                        </td>
                    </tr>
                    <tr>
                        <th>描述：</th>
                        <td>
                            <input type="text" class="lg" name="about_desc" value="{{$field -> about_desc}}">
                        </td>
                    </tr>
                    <tr>
                        <th>缩略图：</th>
                        <td>
                            <input type="text" size="50" name="about_thumb" value="{{$field -> about_thumb}}">
                            <input id="file_upload" name="file_upload" type="file" multiple="true">
                            <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
                            <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
                            <style>
                                .uploadify{display:inline-block;}
                                .uploadify-button{border:none; border-radius:5px; margin-top:8px;}
                                table.add_tab tr td span.uploadify-button-text{color: #FFF; margin:0;}
                            </style>
                            <script type="text/javascript">
                                <?php $timestamp = time();?>
                                $(function() {
                                    $('#file_upload').uploadify({
                                        'buttonText' : 'BROWSE...',
                                        'formData'     : {
                                            'timestamp' : '<?php echo $timestamp;?>',
                                            '_token'     : "{{csrf_token()}}"
                                        },
                                        'swf'      : "{{asset('resources/org/uploadify/uploadify.swf')}}",
                                        'uploader' : "{{url('admin/upload')}}",
                                        'onUploadSuccess' : function(file, data, response) {
                                            $('input[name=about_thumb]').val(data);
                                            $('#about_thumb_img').attr('src','/'+data);
//                                            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
                                        }
                                    });
                                });
                            </script>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <img src="/{{$field -> about_thumb}}" alt="" id="about_thumb_img" style="max-width: 350px; max-height: 100px;">
                        </td>
                    </tr>
                    <tr>
                        <th>联系方式：</th>
                        <td>
                            <input type="text" class="lg" name="about_email" value="{{$field -> about_email}}">
                        </td>
                    </tr>

                    <tr>
                        <th>about内容：</th>
                        <td>
                            <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" name="about_content" type="text/plain" style="width:860px;height:500px;">{!! $field -> about_content !!}</script>
                            <script type="text/javascript">
//                              实例化编辑器
                                var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection