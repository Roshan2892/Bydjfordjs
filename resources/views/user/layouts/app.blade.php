<!DOCTYPE html>
<html>
<head>
    
    <title>@yield('title') : {{ env('APP_NAME') }}</title>
    @include('user.layouts.header')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online promoters for Djs, get latest dj songs, podcast, videos, mixtapes.">
    <meta name="keywords" content="Latest remixes, Dj remix, Bollywood remix, Hip-hop, Edm, Dubstep, Techno, Podcast, Mixtape, Videos">
    <meta name="author" content=" Bydjfordjs">
    <meta name="copyright" content="Copyright Bydjfordjs - 2017">
    <meta name="email" content="bydjfordjsteam@gmail.com">
    <meta http-equiv="Content-Language" content="en">
    <meta name="Charset" content="UTF-8">
    <meta name="Rating" content="General">
    <meta name="Distribution" content="Global">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="7 Days">
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Antic+Slab|Dosis" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::to('/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/media-queries.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/bar-ui.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-plain.css" />
  
</head>
<body>
    <div class="loader"></div>
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

    <div class="container">
        @yield('content')
    </div>

    {{--@include('user.layouts.footer')--}}

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
   <script src="https://use.fontawesome.com/3053be66a0.js"></script>
   <script type="text/javascript" src="{{ URL::to('/js/soundmanager2.js') }}"></script>
   <script src="{{ URL::to('/js/bar-ui.js') }}"></script>
   <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
   <script src="{{ URL::to('/js/slick.js') }}"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
   <script src="{{ URL::to('/js/jssocials.js') }}"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script type="text/javascript">
      $(window).load(function() {
        $(".loader").fadeOut("slow");
      })
   </script>

</body>
</html>
