<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@yield('info')

    {{--<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script><!--Needed for the twitter feed-->--}}
    <script type="text/javascript" src="{{asset('resources/views/home/js/jquery-1.7.2.min.js')}}"></script><!--Needed for the prettyPhoto to function-->
    <script type="text/javascript" src="{{asset('resources/views/home/js/twitter.js')}}"></script><!--needed for various things on the page. Put into a custom file instead of having a bunch of stuff in the header-->
    <script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"  type="text/javascript"></script><!--runs the tabs widgets and toggle widgets-->
    <script type="text/javascript" src="{{asset('resources/views/home/js/simplepager.js')}}"></script><!--runs the pagination-->
    <link rel="stylesheet" href="{{asset('resources/views/home/css/prettyPhoto.css')}}" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

    <script type="text/javascript">
        $(document).ready(function() {
            $('span.category').hover(function(){
                $(this).next().css('background-color','#e25050');
            },function(){
                $(this).next().css('background-color','#393939');
            });


            $(".pageing").quickPager({
                pageSize : 5,
            });
        });
    </script>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="{{asset('resources/views/home/style.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">

    <div id="main">
        <div id="navigation">
            <ul>
                @foreach($navs as $k => $v)
                <li><a class="active" href="{{$v -> nav_url}}">{{$v -> nav_name}}</a></li>
                @endforeach
            </ul>
        </div>

@yield('content')
        <div id="side">
            <div id="sidebar-header">
                <div id="header">
                    <a href="/"><span id="logo">Blog<img src="{{asset('resources/views/home/images/period.png')}}" alt="period" height="8" width="9" /></span></a>
                </div><!--END header-->
                <span class="border"></span>

                {{--<form action="#" method="post">--}}
                    {{--<input type="text" name="search" id="search" placeholder="Search ..." /><br />--}}
                {{--</form>--}}

                <span class="border"></span>
            </div><!--END sidebar-header-->

            <div id="sidebar-widgets">
                <div class="widget recentposts">
                    <h3>最近更新</h3>
                    @foreach($new as $n)
                    <ul>
                        <li class="thumb"><img src="{{url($n -> art_thumb)}}" alt="toons" height="61" width="57" /></li>
                        <li><span class="title"><a href="{{url('a/'.$n -> art_id)}}">{{$n -> art_title}}. .</a></span></li>
                        <li><span class="date">{{date('Y-m-d h:i:s',$n -> art_time)}}</span></li>
                    </ul>
                    <span class="widget-border"></span>
                    @endforeach
                </div><!--END widget-->

                <div class="widget">
                    <h3>最热文章</h3>

                    <ul>
                        @foreach($hot as $h)
                        <li><span class="title"><a href="{{url('a/'.$h -> art_id)}}">{{$h -> art_title}}...</a></span></li>
                        <li><span class="date">By {{$h -> art_editor}}　{{date('Y-m-d h:i:s',$h -> art_time)}}</span></li>
                        <li><span class="widget-border"></span></li>
                        @endforeach
                    </ul>

                </div><!--END widget-->

                <div class="widget cats">
                    <h3>分类</h3>

                    <ul>
                        @foreach($cate as $a)
                        <li><a href="{{url('new/'.$a -> cate_id)}}"><span class="category">{{$a -> _cate_name}}</span><span class="number">{{$a -> cate_view}}</span></a></li>
                        @endforeach
                        <li><span class="widget-border"></span></li>

                    </ul>

                </div><!--END widget-->

                <div class="widget">
                    <h3>画廊</h3>

                    <ul class="gallery">
                        @foreach($photo as $v)
                        <li><a target="_blank" href="{{url($v -> art_thumb)}}" rel="prettyPhoto[sidebargallery]" class="gallery"><img src="{{url($v -> art_thumb)}}" alt="blank" height="46" width="46" /></a></li>
                        @endforeach
                    </ul>
                </div><!--END widget-->
            </div><!--END sidebar-widgets-->
        </div><!--END Side--><!--This div keeps the sidebar from floating right when the main content is empty-->
        <div class="clear"></div>
        <div class="push"></div>
    </div><!--End wrapper-->
    <div id="footer">
        <div id="footerwrap">
            <div class="footerwidgets">
                <div id="aboutauthor">
                    <h1 class="title">ABOUT ME</h1>
                    <span class="widget-border"></span>
                    <p>
                        {!! $about -> about_desc !!}
                    </p>

                    {{--<h1 class="title">FOLLOW ME</h1>--}}
                    {{--<span class="widget-border"></span>--}}
                    {{--<ul id="social">--}}
                        {{--<li><a href="#"><img src="images/twitter.png" alt="twitter" height="31" width="30" /></a></li>--}}
                        {{--<li><a href="#"><img src="images/facebook.png" alt="facebook" height="31" width="30" /></a></li>--}}
                        {{--<li><a href="#"><img src="images/rss.png" alt="rss" height="31" width="30" /></a></li>--}}
                        {{--<li><a href="#"><img src="images/dribble.png" alt="dribble" height="31" width="30" /></a></li>--}}
                        {{--<li><a href="#"><img src="images/flickr.png" alt="flickr" height="31" width="30" /></a></li>--}}
                        {{--<li><a href="#"><img src="images/linkedIn.png" alt="linkedIn" height="31" width="30" /></a></li>--}}
                    {{--</ul>--}}
                </div><!--END aboutauthor -->
            </div><!--END footerwidets-->

            {{--<div class="footerwidgets">--}}
                {{--<div id="archives">--}}
                    {{--<h1 class="title">ARCHIVES</h1>--}}
                    {{--<span class="widget-border"></span>--}}
                    {{--<ul>--}}
                        {{--<li><a href="#">October 2011</a></li>--}}
                        {{--<li><span class="widget-border"></span></li>--}}
                        {{--<li><a href="#">September 2011</a></li>--}}
                        {{--<li><span class="widget-border"></span></li>--}}
                        {{--<li><a href="#">August 2011</a></li>--}}
                        {{--<li><span class="widget-border"></span></li>--}}
                        {{--<li><a href="#">July 2011</a></li>--}}
                        {{--<li><span class="widget-border"></span></li>--}}
                        {{--<li><a href="#">June 2011</a></li>--}}
                        {{--<li><span class="widget-border"></span></li>--}}
                    {{--</ul>--}}
                {{--</div><!--END archives-->--}}
            {{--</div><!--END footerwidets-->--}}

            <div class="footerwidgets">
                <div id="flickr">
                    <h1 class="title">网络相簿</h1>
                    <span class="widget-border "></span>
                    <ul>
                        @foreach($photo as $v)
                            <li><a href="{{url('a/',$v -> art_id)}}" rel="prettyPhoto[foogergallery]" class="gallery"><img src="{{url($v -> art_thumb)}}" alt="flickr" height="46" width="46" /></a></li>
                        @endforeach
                    </ul>
                </div><!--END flickr-->
            </div><!--END footerwidgets-->

            <div class="footerwidgets">
                <div id="twitterfeed">
                    <h1>友情链接</h1>
                    <span class="widget-border"></span>
                    <div id="twitter_update_list">
                        @foreach($links as $l)
                            <a href="{{$l -> link_url}}">{{$l -> link_name}}</a><br/>
                        @endforeach
                        <!--This empty div is the container to hold the twitter tweets-->
                    </div>
                </div><!--END twitterfeed-->
            </div><!--END footerwidgets-->
            <div class="clear"></div><!--clearing floats so it doesn't mess with footer border-->
            <span id="footer-border"></span>
            <div id="footer-navigation">
                <ul>
                    @foreach($navs as $n)
                    <li><a href="{{$n -> nav_url}}">{{$n -> nav_name}}</a></li>
                    @endforeach
                </ul>
            </div><!--END footer-navigation-->

            <div>
                <span id="copyright">{!! Config::get('web.web_Copyright') !!}
            </div><!--END copywrite-->
        </div><!--END footerwrap-->
        <div class="clear"></div>
    </div><!--END footer-->
    <script src="{{asset('resources/views/home/js/jquery.prettyPhoto.js')}}" type="text/javascript" charset="utf-8"></script>
    <script type="{{asset('resources/views/home/text/javascript')}}" charset="utf-8">
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto();
        });
    </script>
    <div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>

</html>