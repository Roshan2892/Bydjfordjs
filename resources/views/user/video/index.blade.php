@extends('user.layouts.app')

@section('content')
    <div class="media_container">
        <h1>Latest Videos</h1><hr>
    @if(count($videos) > 0)
        @foreach($videos as $video)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('video.show',[ 'title' => $video->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$video->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h3>
                                <a href="{{ route('video.show', [ 'title' => $video->seo_title ]) }}">
                                    {{ strlen($video->title) > 40 ? substr($video->title, 0, 40) . ' ..' : $video->title }}
                                </a>
                            </h3>
                            <h4>
                                {!! strlen($video->description) > 60 ? substr($video->description, 0, 60) . ' ..' : $video->description  !!}
                            </h4>
                            <h5><b>Uploaded By:</b> {{ $video->artist }}</h5>
                            <h5>
                                <b>Tags:</b>
                                @foreach(unserialize($video->tags) as $tag)
                                    {{ $tag }}
                                @endforeach
                            </h5>
                            <h6>{{ title_case($video->language) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $videos->links() }}
        @endif
    </div>
@endsection
