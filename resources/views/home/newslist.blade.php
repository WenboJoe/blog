@extends('layouts.home')
@section('info')
    <title>{{$category -> cate_name}}-{{Config::get('web.web_title')}}</title>
    <meta name="author" content="{{Config::get('web.web_author')}}">
    <meta name="keywords" content="{{$category -> cate_keywords}}">
    <meta name="description" content="{{$category -> cate_description}}">
    @endsection
    @section('content')
        <style>
            .tu{
                width: 613px;
                height: 219px;
            }
        </style>
        <div id="main-content">
            <div class="post">
                <div id="ei-slider" class="ei-slider">
                    <ul class="ei-slider-large">
                        @foreach($photon as $pn)
                        <li>
                            <img class="tu" src="{{url($pn -> art_thumb)}}" alt=""/>
                            <div class="ei-title">
                            </div>
                        </li>
                        @endforeach
                    </ul><!-- ei-slider-large -->
                    {{--<ul class="ei-slider-thumbs">--}}
                        {{--<li class="ei-slider-element">Current</li>--}}
                        {{--<li><a href="#">Slide 1</a><img src="images/post-thumb.jpg" alt="" /></li>--}}
                    {{--</ul><!-- ei-slider-thumbs -->--}}
                </div><!-- ei-slider -->

                <span class="main-border"></span>
                {{--<div class="half">--}}
                    {{--<h2>This is an unordered list</h2>--}}
                    {{--<ul class="list">--}}
                        {{--<li>List item 1</li>--}}
                        {{--<li>List item 2</li>--}}
                        {{--<li>List item 3</li>--}}
                        {{--<li>List item 4</li>--}}
                    {{--</ul>--}}
                {{--</div><!--END half-->--}}
                {{--<div class="half-last">--}}
                    {{--<h2>A numbered list</h2>--}}
                    {{--<ol class="list">--}}
                        {{--<li>List item 1</li>--}}
                        {{--<li>List item 2</li>--}}
                        {{--<li>List item 3</li>--}}
                        {{--<li>List item 4</li>--}}
                    {{--</ol>--}}
                {{--</div><!--END half-last-->--}}
                <div class="clear"></div>
                <div class="half">
                    <h2>新闻列表</h2>
                    <ul class="circles">
                        @foreach($newsList as $nl)
                        <li>
                            <a href="{{url('a/'.$nl -> art_id)}}" target="_blank">{{$nl -> art_title}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div><!--END half-->
                @if($submenu)
                <div class="half-last">
                    <h2>新闻分类</h2>
                    <ul class="square">
                        @foreach($submenu as $s)
                        <li>
                            <a href="{{url('news/'.$s -> cate_id)}}">{{$s -> cate_name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!--END half-last-->
            </div><!--END main-content-->
            <div class="Pagination">
                <ul class="pageNav">
                    <li class="currentPage simplePageNav1">
                        {{$newsList -> links()}}
                    </li>
                </ul>

            </div>
            </div><!--end post-->


    </div><!--END main-->
 @endsection