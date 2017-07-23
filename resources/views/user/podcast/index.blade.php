@extends('user.layouts.app')
@section('title')
    PODCAST
@endsection
@section('content')
    <div class="media_container">
        <h1>Latest Podcast</h1><hr>
    @if(count($podcasts) > 0)
        @foreach($podcasts as $podcast)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('podcast.show',[ 'title' => $podcast->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$podcast->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h3>
                                <a href="{{ route('podcast.show', [ 'title' => $podcast->seo_title ]) }}">
                                    {{ strlen($podcast->title) > 40 ? substr($podcast->title, 0, 40) . ' ..' : $podcast->title }}
                                </a>
                            </h3>
                            <h4>
                                {!! strlen($podcast->description) > 60 ? substr($podcast->description, 0, 60) . ' ..' : $podcast->description  !!}
                            </h4>
                            <h5><b>Uploaded By:</b> {{ $podcast->artist }}</h5>
                            <h5>
                                <b>Tags:</b>
                                @foreach(unserialize($podcast->tags) as $tag)
                                    {{ $tag }}
                                @endforeach
                            </h5>
                            <h6>{{ title_case($podcast->language) }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $podcasts->links() }}
        @endif
    </div>
@endsection
