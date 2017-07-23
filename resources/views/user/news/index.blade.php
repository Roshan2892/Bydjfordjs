@extends('user.layouts.app')
@section('title')
    NEWS
@endsection
@section('content')
    <div class="media_container">
        <h1>News</h1><hr>
    @if(count($news) > 0)
        @foreach($news as $new)
            <!-- start row -->
                <div class="row media_content">
                    <div class="col-lg-5 col-sm-5 col-xs-12">
                        <div class="image">
                            <a href="{{ route('news.show',[ 'title' => $new->seo_title ]) }}">
                                <img src="{!!\Illuminate\Support\Facades\Storage::url('uploads/images/'.$new->poster) !!}" alt="" height="200" width="350">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-7 col-xs-12">
                        <div class="description">
                            <h3>
                                <a href="{{ route('news.show', [ 'title' => $new->seo_title ]) }}">
                                    {{ strlen($new->title) > 40 ? substr($new->title, 0, 40) . ' ..' : $new->title }}
                                </a>
                            </h3>
                            <h4>
                                {!! strlen($new->description) > 60 ? substr($new->description, 0, 60) . ' ..' : $new->description  !!}
                            </h4>
                            <h5>
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
        @endif
    </div>
@endsection
