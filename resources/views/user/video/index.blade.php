@extends('user.layouts.app')

@section('content')
    <div class="container">
        <h1>Videos</h1>
        @if(count($videos) > 0)
           {{-- {{ $videos->links() }}--}}

            @foreach($videos as $video)
                <div class="row">
                    <div class="col-md-2 col-sm-12" >
                        <div class="image" style="background:white;">
                            <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$video->poster) }}" alt="" height="150" width="250">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-9 col-sm-12">
                        <div class="container">
                            <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">{{ $video->title }}</a>

                        </div>
                        {{--<div class="container">--}}
                            {{--{!! $video->description !!}--}}
                        {{--</div>--}}
                        <div class="container">
                           By {{ $video->artist }}
                        </div>

                        <div class="container">
                            {{ $video->created_at }}
                        </div>

                        <div class="container">
                            @foreach(unserialize($video->tags) as $tag)
                                {{ $tag }}
                            @endforeach
                        </div>
                        {{--<div class="container">--}}
                            {{--{{ $video->language }}--}}
                        {{--</div>--}}

                    </div>
                </div>
            @endforeach

            {{ $videos->links() }}
        @endif
    </div>
@endsection