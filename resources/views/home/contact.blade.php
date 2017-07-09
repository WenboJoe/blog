@extends('layouts.home')
@section('info')
    <title>{{$email -> about_title}}-{{Config::get('web.web_title')}}</title>
    <meta name="author" content="{{$email -> about_author}}">
    <meta name="keywords" content="{{Config::get('web.web_keywords')}}">
    <meta name="description" content="{{Config::get('web.web_description')}}">
@endsection
@section('content')
        <div id="main-content">
            <div id="contact-page">
                <h1>CONTACT ME</h1>

                {{--<span class="main-border"></span>--}}
                {{--<div id="contact-info">--}}

                    {{--<h2>John Smith</h2>--}}
                    {{--<ul class="contact-list">--}}
                        {{--<li>123 Long Street<br  /> London, England</li>--}}
                    {{--</ul>--}}
                    {{--<ul class="list2">--}}
                        {{--<li><span class="bold">Phone: </span>+123 456 789</li>--}}
                        {{--<li><span class="bold">Email:</span> info@something.com</li>--}}
                    {{--</ul>--}}
                    {{--<a href="#"><span id="contact-twitter"></span></a>--}}
                    {{--<a href="#"><span id="contact-facebook"></span></a>--}}
                {{--</div><!--END contact-info-->--}}
                {{--<div id="map">--}}
                    {{--<iframe width="425" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Envato+Pty+Ltd,+Elizabeth+Street,+Melbourne,+Victoria,+Australia&amp;aq=0&amp;oq=envato&amp;sll=37.0625,-95.677068&amp;sspn=57.030354,135.263672&amp;t=h&amp;ie=UTF8&amp;hq=Envato+Pty+Ltd,+Elizabeth+Street,&amp;hnear=Melbourne+Victoria,+Australia&amp;ll=-37.812332,144.968956&amp;spn=0.006295,0.012981&amp;output=embed"></iframe>--}}

                {{--</div><!--END map-->--}}

                <div class="clear"></div>
                {{--<h1 id="contact-h1">SEND ME A MESSAGE</h1>--}}
                <span class="main-border"></span>

                <div class="contact_form" ">
                    <ul>
                        {{--<li>--}}
                            {{--<span class="required_notification">* Denotes Required Field</span>--}}
                        {{--</li>--}}
                        <li>
                            <label for="contactname">Name</label>
                            <input type="text" name="contactname" id="contactname" placeholder="John Doe" required value="{{$email -> about_author}}"/>
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="john_doe@example.com" required value="{{$email -> about_email}}" />
                            <span class="form_hint">Proper format "name@something.com"</span>
                        </li>
                        <li>
                            <label for="website">Website</label>
                            <input type="url" name="website" id="website" placeholder="{{$nav -> nav_url}}" />
                            {{--<span class="form_hint">Proper format "http://someaddress.com"</span>--}}
                        </li>

                    </ul>
                </div>		<div class="intro"></div>
            </div><!--END contact-page-->
        </div><!--END main-content-->
    </div><!--END main-->
 @endsection