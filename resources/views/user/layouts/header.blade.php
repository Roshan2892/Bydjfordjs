<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Music <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('singles.index') }}">Albums</a></li>
                            <li><a href="{{ route('albums.index') }}">Singles</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('video.index') }}">Video</a></li>
                    <li><a href="{{ route('podcast.index') }}">Podcast</a></li>
                    <li><a href="{{ route('news.index') }}">News</a></li>
                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>