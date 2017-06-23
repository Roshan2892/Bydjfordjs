@extends('user.layouts.app')

@section('content')
    <!-- start container -->
    <div class="container"> 

        <!-- start row -->        
        <div class="row">

            <!-- start col-lg-9 -->
            <div class="col-lg-9 col-md-9 col-sm-9">

                <!-- start singles -->
                <div class="latest_singles">
                    <h2><span>Latest Singles</span></h2>
                    <div class="view_more">
                        <a href="{{ route('singles.index') }}">view more...</a>
                    </div>
                    <div class="latest_post_container post_slider">
                        @if(count($singles))
                            @foreach($singles as $music)
                                <div class="container">
                                    <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                                        <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) }}" width="200" height="150" alt="Single By {{$music->artist}}">
                                        <h3>{{ $music->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end singles -->

                <!-- end albums -->
                <div class="latest_albums">
                    <h2><span>Latest Albums</span></h2>
                    <div class="view_more">
                        <a href="{{ route('albums.index') }}">view more...</a>
                    </div>  
                    <div class="latest_post_container post_slider">
                        @if(count($albums))
                            @foreach($albums as $music)
                                <div class="container">
                                    <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                                        <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) }}" width="200" height="150" alt="Album By {{$music->artist}}">
                                        <h3>{{ $music->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end albums -->

                <!-- start videos -->
                <div class="latest_videos">
                    <h2><span>Latest Videos</span></h2>
                    <div class="view_more">
                        <a href="{{ route('video.index') }}">view more...</a>
                    </div>  
                    <div class="latest_post_container post_slider">
                        @if(count($videos))
                            @foreach($videos as $video)
                                <div class="container">
                                    <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">
                                        <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$video->poster) }}" width="200" height="150" alt="Video By {{$video->artist}}">
                                        <h3>{{ $video->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end videos -->

                <!-- start podcast -->
                <div class="latest_podcast">
                    <h2><span>Latest Podcasts</span></h2>
                    <div class="view_more">
                        <a href="{{ route('podcast.index') }}">view more...</a>
                    </div>  
                    <div class="latest_post_container post_slider">
                        @if(count($podcast))
                            @foreach($podcast as $pod)
                                <div class="container">
                                    <a href="{{ route('podcast.show',[ 'title' => $pod->seo_title ]) }}">
                                        <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$pod->poster) }}" width="200" height="150" alt="Podcast By {{$pod->artist}}">
                                        <h3>{{ $pod->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end podcast -->

            </div>
            <!-- end col-lg-9 -->

            <!-- start col-lg-3 -->
            <div class="col-lg-3 col-md-3 col-sm-3">

                <!-- start news -->
                <div class="lastest_news">
                    <h2><span>Latest News</span></h2>
                    <div class="view_more">
                        <a href="{{ route('news.index') }}">view more...</a>
                    </div>
                    <div class="latest_post_container ">
                        @if(count($news))
                            @foreach($news as $new)
                                <div class="container">
                                    <a href="{{ route('news.show',[ 'title' => $new->seo_title ]) }}">
                                        <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) }}" width="200" height="150" alt="{{$new->title}} ">
                                        <h3>{{ $new->title }}</h3>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- end news -->

            </div>
            <!-- end col-lg-3 -->

        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

@endsection