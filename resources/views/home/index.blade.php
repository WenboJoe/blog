@extends('layouts.home')
@section('info')
    <title>{{Config::get('web.web_title')}}-{{Config::get('web.seo_title')}}</title>
    <meta name="author" content="{{Config::get('web.web_author')}}">
    <meta name="keywords" content="{{Config::get('web.web_keywords')}}">
    <meta name="description" content="{{Config::get('web.web_description')}}">
@endsection
@section('content')
    <style>
        .image{
            background: #fff;
            width: 609px;
            height: 340px;
        }
    </style>
        <!--END navigation-->
        <div id="main-content">
            <ul class="pageing">
                @foreach($data as $v)
                <li>
                    <div class="post">
                        <h1 class="title">{{$v -> art_title}}</h1>
                        <span class="twitter"><a href="#"></a></span>
                        <span class="facebook"><a href="#"></a></span>
                        <div class="meta">
                            <ul >
                                <li class="admin">{{$v -> art_editor}}</li>
                                <li class="date">{{date('Y-m-d',$v -> art_time)}}</li>
                                <li class="category"><a href="{{url('news/'.$v -> cate_id)}}">{{$v -> cate_name}}</a></li>
                                <li class="comments">{{$v -> art_view}}</li>
                            </ul>
                        </div><!--end meta-->

                        <span class="main-border"></span>

                        <img class="image" src="{{url($v -> art_thumb)}}" alt="post image"/>

                        <p>{{$v -> art_description}}.</p>
                        <a class="read-more" href="{{url('a/'.$v -> art_id)}}">Read More</a>
                        <div class="clear"></div>
                    </div><!--END post-->
                </li>
                @endforeach
<!--END post-->
            </ul>

            <div class="Pagination">
                <ul class="pageNav">
                    <li class="currentPage simplePageNav1">
                        {{$data -> links()}}
                    </li>
                </ul>

            </div>
            <div class="clear"></div>
        </div><!--END main-content-->
    </div>
        <!--END main-->

@endsection
