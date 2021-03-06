<div id="app">
    <div class="container-fluid" style="background: #222;">
        <!-- Branding Image -->
        <a style="font-size: 22px;" class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
           <!-- <img src="{{ URL::to('image/assets/logo1.png') }}" alt="" >-->
        </a>
        <div class="social_links header_share">
           <!-- <img src="{{ URL::to('image/assets/fb.png') }}" alt="" >
            <img src="{{ URL::to('image/assets/twitter.png') }}" alt="" >
            <img src="{{ URL::to('image/assets/google.png') }}" alt="" >
            <img src="{{ URL::to('image/assets/youtube.png') }}" alt="" > -->
        </div>
    </div>

    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Music <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('singles.index') }}">Singles</a></li>
                            <li><a href="{{ route('albums.index') }}">Albums</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('video.index') }}">Video</a></li>
                    <li><a href="{{ route('podcast.index') }}">Podcast</a></li>
                    <li><a href="{{ route('news.index') }}">News</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
                @if(!Request::is('search'))
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <form class="navbar-form" >
                                <div class="form-group" style="display:inline;">
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" onclick="goToSearch();">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-search" onclick="goToSearch();"></span></span>
                                  </div>
                                </div>
                           </form>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</div>

<script>
    function goToSearch() {
        window.location.href = '{{route("search")}}';
    }
</script>
