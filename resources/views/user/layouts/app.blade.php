<!DOCTYPE html>
<html>
<head>
	<title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ URL::to('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/user_styles.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/bar-ui.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    </head>
<body>

    {{--<header>--}}
        {{--<a href="{{ route('home') }}" title='Home'>--}}
            {{--<img src="{{ URL::to('/image/assets/home.png') }}" border="0" alt="" style="width:200px;height: 45px;margin-top: -3px;">--}}
        {{--</a>--}}
        {{--<a href="{{ route('about') }}" title='About'>--}}
            {{--<img src="{{ URL::to('/image/assets/about.png') }}" style="width:200px;height: 45px;margin-top: -3px;" border="0" alt="">--}}
        {{--</a>--}}

        {{--<a href="{{ route('video.index') }}" title='Video'>--}}
            {{--<img src="{{ URL::to('/image/assets/Video.png') }}"  style="width:200px;height: 47px;margin-top: -3px;" border="0" alt="">--}}
        {{--</a>--}}

        {{--<a href="{{ route('music.index') }}" title='Music'>--}}
            {{--<img src="{{ URL::to('/image/assets/Music.png') }}"  style="width:200px;height: 45px;margin-top: -3px;" border="0" alt="">--}}
        {{--</a>--}}

        {{--<img src="{{ URL::to('/image/assets/home_05.png') }}" style="width:550px;height: 45px;margin-top: -3px;" border="0" alt="">--}}
    {{--</header>--}}

    @include('user.layouts.header')


    @yield('content')

    @include('user.layouts.footer')


<script src="{{ URL::to('/js/jquery.js') }}"></script>
<script src="{{ URL::to('/js/bootstrap.min.js') }}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="https://use.fontawesome.com/3053be66a0.js"></script>
<script type="text/javascript" src="{{ URL::to('/js/soundmanager2.js') }}"></script>
<script src="{{ URL::to('/js/bar-ui.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="{{ URL::to('/js/slick.js') }}"></script>
</body>
</html>
