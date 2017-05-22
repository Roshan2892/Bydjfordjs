@extends('user.layouts.app')

@section('content')
    <div class="container">
        <h1>Latest News</h1>
        @if(count($news) > 0)
           {{-- {{ $videos->links() }}--}}

            @foreach($news as $new)
                <div class="row">
                    <div class="col-md-2 col-sm-12" >
                        <div class="image" style="background:white;">
                            <a href="{{ route('news.show',[ 'id' => $new->id ]) }}">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) }}" alt="" height="150" width="250">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-9 col-sm-12">
                        <div class="container">
                            <a href="{{ route('news.show',[ 'id' => $new->id ]) }}">{{ $new->title }}</a>

                        </div>
                        {{--<div class="container">--}}
                            {{--{!! $video->description !!}--}}
                        {{--</div>--}}
                        <div class="container">
                            {{ $new->created_at }}
                        </div>

                        <div class="container">
                            @foreach(unserialize($new->tags) as $tag)
                                {{ $tag }}
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $news->links() }}
        @endif
    </div>
@endsection