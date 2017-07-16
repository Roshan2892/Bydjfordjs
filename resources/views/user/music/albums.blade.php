@extends('user.layouts.app')

@section('content')
    <div class="media_container">
        <h1>Latest Albums</h1><hr>
    @if(count($musics) > 0)
        @foreach($musics as $music)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('music.show',[ 'title' => $music->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h3>
                                <a href="{{ route('music.show', [ 'title' => $music->seo_title ]) }}">
                                    {{ strlen($music->title) > 40 ? substr($music->title, 0, 40) . ' ..' : $music->title }}
                                </a>
                            </h3>
                            <h4>
                                {!! strlen($music->description) > 60 ? substr($music->description, 0, 60) . ' ..' : $music->description  !!}
                            </h4>
                            <h5><b>Uploaded By:</b> {{ $music->artist }}</h5>
                            <h5>
                                <b>Tags:</b>
                                @foreach(unserialize($music->tags) as $tag)
                                    {{ $tag }}
                                @endforeach
                            </h5>
                            <h6>{{ title_case($music->language) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $musics->links() }}
        @endif
    </div>
@endsection
