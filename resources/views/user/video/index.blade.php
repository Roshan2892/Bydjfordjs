@extends('user.layouts.app')
@section('title')
    VIDEO
@endsection
@section('content')
    <div class="media_container">
        <h1>Latest Videos</h1><hr>
    <div class="data_slider">
    @if(count($videos) > 0)
        @foreach($videos as $video)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$video->poster) !!}" alt="" height="300" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h1>
                                <a href="{{ route('video.show', [ 'title' => $video->seo_title ]) }}">
                                    {{ strlen($video->title) > 40 ? substr($video->title, 0, 40) . ' ..' : $video->title }}
                                </a>
                            </h1>
                            <h5 class="music_desc">
                                {!! strlen($video->description) > 150 ? substr($video->description, 0, 150) . ' ..' : $video->description  !!}
                            </h5>
                            <h5 class="music_artist"><b>Artist:</b> {{ $video->artist }}</h5>
                            <h5 class="music_tags">
                                <b>Tags:</b>
                                @foreach(unserialize($video->tags) as $tag)
                                    {{ $tag }}
                                @endforeach
                            </h5>
                            <h5 class="music_lang">{{ title_case($video->language) }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $videos->links() }}
        @else
             <div class='coming_soon'>
               <img src="../image/assets/comingsoon.jpg" title='Coming Soon' alt="COMING SOON" width='100%' height="400">
            </div>
        @endif
     </div>
    </div>
@endsection
