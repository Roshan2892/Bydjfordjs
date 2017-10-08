@extends('user.layouts.app')

@section('title')
    HOME
@endsection

@section('content')
    <!-- start row -->
    <div class="row main_content">

        <!-- start col-md-8 -->
        <div class="col-lg-8 col-sm-12 sub_content">

            <!-- start singles -->
            <div class="latest_singles latest_media">
                <h1>Latest Singles</h1>
                <div class="view_more">
                    <a href="{{ route('singles.index') }}" class="button2">view more</a>
                </div><hr>
                <div class="latest_post_container post_slider">
                    @if(count($singles))
                        @foreach($singles as $music)
                            <div class="singles">
                                <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                                    <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) }}"  height="250" alt="Single By {{$music->artist}}">
                                    <h2>{{ strlen($music->title) > 20 ? substr($music->title,0, 20) . '...' : $music->title }}</h2>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- end singles -->

            <!-- end albums -->
            <div class="latest_albums latest_media">
                <h1>Latest Albums</h1>
                <div class="view_more">
                    <a href="{{ route('albums.index') }}" class="button2">view more</a>
                </div><hr>
                <div class="latest_post_container post_slider">
                    @if(count($albums))
                        @foreach($albums as $music)
                            <div class="albums">
                                <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                                    <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) }}"  height="250" alt="Album By {{$music->artist}}">
                                    <h2>{{ strlen($music->title) > 20 ? substr($music->title,0, 20) . '...' : $music->title }}</h2>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- end albums -->

            <!-- start videos -->
            <div class="latest_videos latest_media">
                <h1>Latest Videos</h1>
                <div class="view_more">
                    <a href="{{ route('video.index') }}" class="button2">view more</a>
                </div><hr>
                <div class="latest_post_container post_slider ">
                    @if(count($videos))
                        @foreach($videos as $video)
                            <div class="videos ">
                                <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">
                                    <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$video->poster) }}" height="250" alt="Video By {{$video->artist}}">
                                    <h2>{{ strlen($video->title) > 20 ? substr($video->title,0, 20) . '...' : $video->title }}</h2>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- end videos -->

            <!-- start podcast -->
            <div class="latest_podcast latest_media">
                <h1>Latest Podcasts</h1>
                <div class="view_more">
                    <a href="{{ route('podcast.index') }}" class="button2">view more</a>
                </div><hr>
                <div class="latest_post_container post_slider">
                    @if(count($podcast))
                        @foreach($podcast as $pod)
                            <div class="podcast">
                                <a href="{{ route('podcast.show',[ 'title' => $pod->seo_title ]) }}">
                                    <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$pod->poster) }}" height="250" alt="Podcast By {{$pod->artist}}">
                                    <h2>{{ strlen($pod->title) > 20 ? substr($pod->title,0, 20) . '...' : $pod->title }}</h2>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- end podcast -->

        </div>
        <!-- end col-md-8 -->

        <!-- start col-md-4 -->
        <div class="col-lg-4 col-xs-12 news_content">

            <!-- start news -->
            <div class="lastest_news latest_media">
                <h1>Latest News</h1>
                <div class="view_more">
                    <a href="{{ route('news.index') }}" class="button2">view more</a>
                </div><hr>
                <div class="latest_post_container">
                @if(count($news))
                    @foreach($news as $new)
                        <div class="news">
                            <a href="{{ route('news.show',[ 'title' => $new->seo_title ]) }}">
                                <img src="{{  \Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) }}" width="300" height="250" alt="{{$new->title}} ">
                                <h2>{{ strlen($new->title) > 25 ? substr($new->title,0, 25) . '...' : $new->title }}</h2>
                            </a>
                        </div>
                        <hr>
                    @endforeach
                @endif
                </div>
            </div>
            <!-- end news -->

        </div>
        <!-- end col-md-4 -->

    </div>
    <!-- end row -->
@endsection