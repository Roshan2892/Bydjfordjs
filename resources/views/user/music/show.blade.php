@extends('user.layouts.app')
@section('title')
    @if(!empty($music))
        @foreach($music as $details)
            {{ strtoupper($details->title) }}
        @endforeach
    @endif
@endsection
@section('content')
    <div class="media_container">
        @if(!empty($music))
            @foreach($music as $details)
                <div class="row">
                    <div class="col-lg-12">
                        <h1>{{ title_case($details->title) }}</h1><hr>
                        {{--<div class="col-lg-offset-4 col-lg-8 ">--}}
                            <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$details->poster) }}"
                             width="400" height="300" alt="Poster">
                        {{--</div>--}}
                        <span><small>{!! $details->description !!}</small></span>
                        <div class="sm2-bar-ui playlist-open">

                            <div class="bd sm2-main-controls">

                                <div class="sm2-inline-texture"></div>
                                <div class="sm2-inline-gradient"></div>

                                <div class="sm2-inline-element sm2-button-element">
                                    <div class="sm2-button-bd">
                                        <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
                                    </div>
                                </div>

                                <div class="sm2-inline-element sm2-inline-status">

                                    <div class="sm2-playlist">
                                        <div class="sm2-playlist-target">
                                            <!-- playlist <ul> + <li> markup will be injected here -->
                                            <!-- if you want default / non-JS content, you can put that here. -->
                                            <noscript><p>JavaScript is required.</p></noscript>
                                        </div>
                                    </div>

                                    <div class="sm2-progress">
                                        <div class="sm2-row">
                                            <div class="sm2-inline-time">0:00</div>
                                            <div class="sm2-progress-bd">
                                                <div class="sm2-progress-track">
                                                    <div class="sm2-progress-bar"></div>
                                                    <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
                                                </div>
                                            </div>
                                            <div class="sm2-inline-duration">0:00</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="sm2-inline-element sm2-button-element sm2-volume">
                                    <div class="sm2-button-bd">
                                        <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
                                        <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
                                    </div>
                                </div>

                                <div class="sm2-inline-element sm2-button-element">
                                    <div class="sm2-button-bd">
                                        <a href="#prev" title="Previous" class="sm2-inline-button previous">&lt; previous</a>
                                    </div>
                                </div>

                                <div class="sm2-inline-element sm2-button-element">
                                    <div class="sm2-button-bd">
                                        <a href="#next" title="Next" class="sm2-inline-button next">&gt; next</a>
                                    </div>
                                </div>

                                <div class="sm2-inline-element sm2-button-element sm2-menu">
                                    <div class="sm2-button-bd">
                                        <a href="#menu" class="sm2-inline-button menu">menu</a>
                                    </div>
                                </div>

                            </div>

                            <div class="bd sm2-playlist-drawer sm2-element">

                                <div class="sm2-inline-texture">
                                    <div class="sm2-box-shadow"></div>
                                </div>

                                <!-- playlist content is mirrored here -->

                                <div class="sm2-playlist-wrapper">
                                    <ul class="sm2-playlist-bd">
                                        @for($i = 0; $i < count($files); $i++)
                                            <li>
                                                <a href="{{ \Illuminate\Support\Facades\Storage::url('uploads/files/'.$files[$i]) }} ">
                                                    <b>{!!  $fileNames[$i] !!}</b>
                                                </a>
                                                {{ Form::open(array('route' => array('music.download', $files[$i] ), 'method' => 'get')) }}
                                                <button class="btn"><i class="fa fa-download" aria-hidden="true"></i></button>
                                                {{ Form::close() }}
                                            </li>
                                        @endfor
                                    </ul>
                                </div>

                                <div class="sm2-extra-controls">
                                    <div class="bd">
                                        {{--<div class="sm2-inline-element sm2-button-element">--}}
                                        <a href="#prev" title="Previous" class="sm2-inline-button previous">&lt; previous</a>
                                        {{--</div>--}}
                                        {{--<div class="sm2-inline-element sm2-button-element">--}}
                                        <a href="#next" title="Next" class="sm2-inline-button next">&gt; next</a>
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>

                        <h3>{{ $details->artist }}</h3><br>
                        <br>
                        {{ title_case($details->language) }}<br>
                        @foreach(unserialize($details->tags) as $tags)
                            {{ $tags }}
                        @endforeach

                        <br>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>  
@endsection