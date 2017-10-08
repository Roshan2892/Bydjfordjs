@extends('user.layouts.app')
@section('title')
    NEWS
@endsection
@section('content')
    <div class="media_container">
        <h1>News</h1><hr>
<div class="data_slider">
    @if(count($news) > 0)
        @foreach($news as $new)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('news.show',[ 'title' => $new->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="" height="300" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h1>
                                <a href="{{ route('news.show', [ 'title' => $new->seo_title ]) }}">
                                    {{ strlen($new->title) > 40 ? substr($new->title, 0, 40) . ' ..' : $new->title }}
                                </a>
                            </h1>
                            <h5 class="music_desc">
                                {!! strlen($new->description) > 150 ? substr($new->description, 0, 150) . ' ..' : $new->description  !!}
                            </h5>
                            <h5 class="music_tags">
                                    <b>Tags:</b>
                                    @foreach(unserialize($new->tags) as $tag)
                                        {{ $tag }}
                                    @endforeach
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $news->links() }}
        @else
              <div class='coming_soon'>
               <img src="../image/assets/comingsoon.jpg" title='Coming Soon' alt="COMING SOON" width='100%' height="400">
            </div>
        @endif
       </div>
    </div>
@endsection
