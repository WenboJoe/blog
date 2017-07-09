@extends('layouts.home')
@section('info')
    <title>{{$article -> art_title}}-{{Config::get('web.web_title')}}</title>
    <meta name="author" content="{{$article -> art_editor}}">
    <meta name="keywords" content="{{$article -> art_tag}}">
    <meta name="description" content="{{$article -> art_description}}">
@endsection
@section('content')
    <style>
        .image{
            background: #fff;
            width: 609px;
            height: 335px;
        }
    </style>
    <div id="main-content">
        <div id="post-page">
            <div class="post">
                <h1 class="title">{{$article -> art_title}}</h1>
                <span class="twitter"><a href="#"></a></span>
                <span class="facebook"><a href="#"></a></span>
                <div class="meta">
                    <ul >
                        <li class="admin"><a href="#">{{$article -> art_editor}}</a></li>
                        <li class="date">{{date('Y-m-d H:i:s',$article -> art_time)}}</li>
                        <li class="category"><a href="{{url('news/'.$article -> cate_id)}}">{{$article -> cate_name}}</a></li>
                        <li class="comments">{{$article -> art_view}}</li>
                    </ul>
                </div><!--end meta-->
                <span class="main-border"></span>

                <img class="image" src="{{url($article -> art_thumb)}}" alt="post image" height="350" width="609" />

                <p>{!! $article -> art_content !!}</p>

                <span class="main-border"></span>
                <div class="keybq">
                    <p><span>关键字词</span>：{{$article->art_tag}}</p>
                </div>

                <div class="nextinfo">
                    <p>上一篇：
                        @if($field['pre'])
                        <a href="{{url('a/'.$field['pre'] -> art_id)}}">{{$field['pre'] -> art_title}}</a>
                        @else
                            <span>没有上一篇了</span>
                        @endif
                    </p>
                    <p>下一篇：
                        @if($field['next'])
                            <a href="{{url('a/'.$field['next'] -> art_id)}}">{{$field['next'] -> art_title}}</a>
                        @else
                            <span>没有下一篇了</span>
                        @endif
                    </p>
                </div>
                <div class="otherlink">
                    <h2>相关文章</h2>
                    <ul>
                        @foreach($data as $v)
                        <li><a href="{{url('a/'.$v -> art_id)}}" title="{{$v -> art_title}}">{{$v -> art_title}}</a></li>
                        @endforeach
                    </ul>
                </div>



            {{--<div class="user-comment">--}}
                    {{--<div class="avatar"><img src="images/avatar.jpg" alt="avatar" height="51" width="51" /></div>--}}

                    {{--<div class="comment-meta">--}}
                        {{--<ul>--}}
                            {{--<li class="comment-author">Admin,</li>--}}
                            {{--<li class="comment-date">November 21, 2012 at 7:30PM - </li>--}}
                            {{--<li class="comment-reply"><a href="#">Reply</a></li>--}}
                        {{--</ul>--}}
                    {{--</div><!--END comment-meta-->--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec urna in velit mollis semper quis vel sapien. Aenean tristique, diam sed sollicitudin convallis, diam sapien fermentum odio, non venenatis turpis dolor vitae nunc. Donec vestibulum erat et nisi semper et dignissim diam molestie.</p>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div><!--END user-comment-->--}}

                {{--<div class="user-comment">--}}
                    {{--<div class="avatar"><img src="images/avatar.jpg" alt="avatar" height="51" width="51" /></div>--}}

                    {{--<div class="comment-meta">--}}
                        {{--<ul>--}}
                            {{--<li class="comment-author">Admin,</li>--}}
                            {{--<li class="comment-date">November 21, 2012 at 7:30PM - </li>--}}
                            {{--<li class="comment-reply"><a href="#">Reply</a></li>--}}
                        {{--</ul>--}}
                    {{--</div><!--END comment-meta-->--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec urna in velit mollis semper quis vel sapien. Aenean tristique, diam sed sollicitudin convallis, diam sapien fermentum odio, non venenatis turpis dolor vitae nunc. Donec vestibulum erat et nisi semper et dignissim diam molestie.</p>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div><!--END user-comment-->--}}

                {{--<div class="user-comment reply-comment">--}}
                    {{--<div class="avatar"><img src="images/avatar.jpg" alt="avatar" height="51" width="51" /></div>--}}

                    {{--<div class="comment-meta">--}}
                        {{--<ul>--}}
                            {{--<li class="comment-author">Admin,</li>--}}
                            {{--<li class="comment-date">November 21, 2012 at 7:30PM - </li>--}}
                            {{--<li class="comment-reply"><a href="#">Reply</a></li>--}}
                        {{--</ul>--}}
                    {{--</div><!--END comment-meta-->--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec urna in velit mollis semper quis vel sapien. Aenean tristique, diam sed sollicitudin convallis, diam sapien fermentum odio, non venenatis turpis dolor vitae nunc. Donec vestibulum erat et nisi semper et dignissim diam molestie.</p>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div><!--END user-comment-->--}}

                {{--<div class="user-comment reply-comment">--}}
                    {{--<div class="avatar"><img src="images/avatar.jpg" alt="avatar" height="51" width="51" /></div>--}}

                    {{--<div class="comment-meta">--}}
                        {{--<ul>--}}
                            {{--<li class="comment-author">Admin,</li>--}}
                            {{--<li class="comment-date">November 21, 2012 at 7:30PM - </li>--}}
                            {{--<li class="comment-reply"><a href="#">Reply</a></li>--}}
                        {{--</ul>--}}
                    {{--</div><!--END comment-meta-->--}}

                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nec urna in velit mollis semper quis vel sapien. Aenean tristique, diam sed sollicitudin convallis, diam sapien fermentum odio, non venenatis turpis dolor vitae nunc. Donec vestibulum erat et nisi semper et dignissim diam molestie.</p>--}}
                    {{--<div class="clear"></div>--}}
                {{--</div><!--END user-comment-->--}}



                {{--<span class="main-border"></span>--}}

                {{--<h1 id="comment">SUBMIT COMMENT</h1>--}}

                {{--<form class="contact_form" action="#" method="post" name="contact_form">--}}
                    {{--<ul>--}}

                        {{--<li>--}}
                            {{--<label for="name">Name</label>--}}
                            {{--<input type="text" id="name" name="name" placeholder="John Doe" required />--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<label for="email">Email</label>--}}
                            {{--<input type="email" id="email" name="email" placeholder="john_doe@example.com" required />--}}
                            {{--<span class="form_hint">Proper format "name@something.com"</span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<label for="website">Website</label>--}}
                            {{--<input type="url" id="website" name="website" placeholder="http://johndoe.com" pattern="(http|https)://.+"/>--}}
                            {{--<span class="form_hint">Proper format "http://someaddress.com"</span>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<textarea name="message" cols="40" rows="6" required ></textarea>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<button class="submit" type="submit">Submit</button>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</form>--}}
            </div><!--end post-->
        </div><!--END post-page-->
    </div><!--END main-content-->
    </div><!--END main-->
@endsection