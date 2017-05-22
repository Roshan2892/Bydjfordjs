@extends('user.layouts.app')

@section('content')
        <h1>Podcast</h1>
        @if(count($podcasts) > 0)
            @foreach($podcasts as $podcast)
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="image">
                            <a href="{{ route('podcast.show',[ 'id' => $podcast->id ]) }}">
                                <img src="{!! \Illuminate\Support\Facades\Storage::url('uploads/images/'.$podcast->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>
                            <a href="{{ route('podcast.show',[ 'id' => $podcast->id ]) }}">{{ $podcast->title }}</a>
                        </h3>

                        {{--<h4>--}}
                            {{--{!! $music->description !!}--}}
                        {{--</h4>--}}
    
                        <h5>
                           By {{ $podcast->artist }}
                        </h5>
                        <h5>{{ $podcast->created_at }}</h5>
                        {{--<h5>--}}
                            {{--{{ title_case($music->language) }}--}}
                        {{--</h5>--}}

                        <span>
                            Tags:
                            @foreach(unserialize($podcast->tags) as $tag)
                                {{ $tag }}
                            @endforeach
                        </span>
                    </div>
                </div>
            @endforeach

            {{ $podcasts->links() }}
        @endif
@endsection