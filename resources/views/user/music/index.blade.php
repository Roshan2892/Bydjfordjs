@extends('user.layouts.app')

@section('content')
     <!-- start container --> 
      @if(count($musics) > 0)
            @foreach($musics as $music)
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="image">
                            <a href="{{ route('music.show',[ 'id' => $music->id ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3>
                            <a href="{{ route('music.show',[ 'id' => $music->id ]) }}">{{ $music->title }}</a>
                        </h3>

                        {{--<h4>--}}
                            {{--{!! $music->description !!}--}}
                        {{--</h4>--}}
    
                        <h5>
                           By {{ $music->artist }}
                        </h5>
                        <h5>{{ $music->created_at }}</h5>
                        {{--<h5>--}}
                            {{--{{ title_case($music->language) }}--}}
                        {{--</h5>--}}

                        <span>
                            Tags:
                            @foreach(unserialize($music->tags) as $tag)
                                {{ $tag }}
                            @endforeach
                        </span>
                    </div>
                </div>
            @endforeach

            {{ $musics->links() }}
        @endif  
@endsection