@extends('user.layouts.app')
@section('title')
    SINGLES
@endsection
@section('content')
    <div class="media_container">
        <h1>Latest Singles</h1><hr>
        <div class="data_slider">
        @if(count($musics) > 0)
            @foreach($musics as $music)
            <!-- start row -->
            <div class="row media_content">
                <div class="col-lg-5 col-sm-5 col-xs-12">
                    <div class="image">
                        <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                            <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) !!}" alt="" height="300" width="350">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-7 col-xs-12">
                    <div class="description">
                        <h1>
                            <a href="{{ route('music.show', [ 'title' => $music->seo_title ]) }}">
                                {{ strlen($music->title) > 40 ? substr($music->title, 0, 40) . '..' : $music->title }}
                            </a>
                        </h1>
                        <h5 class="music_desc">
                            {!! strlen($music->description) > 150 ? substr($music->description, 0, 150) . '..' : $music->description  !!}
                        </h5>
                        <h5 class="music_artist"><b>Artist:</b> {{ $music->artist }}</h5>
                        <h5 class="music_tags">
                            <b>Tags:</b>
                            @foreach(unserialize($music->tags) as $tag)
                                 {{ $tag }}
                            @endforeach
                        </h5>
                        <h5 class="music_lang">{{ title_case($music->language) }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $musics->links() }} 
        @else
             <div class='coming_soon'>
               <img src="../image/assets/comingsoon.jpg" title='Coming Soon' alt="COMING SOON" width='100%' height="400">
            </div>
        @endif
    </div>
    </div>
@endsection