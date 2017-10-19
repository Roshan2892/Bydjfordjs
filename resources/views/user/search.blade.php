@extends('user.layouts.app')

@section('title')
    SEARCH
@endsection

@section('content')
    <!-- start container -->
    <div class="row">
        <div class="col-lg-12 col-sm-12 search_container">
            <h1>Search</h1><hr>
            <div class="search_content">
                {!! Form::open(['route'=>'search'], ['class' => 'form-horizontal']) !!}
                {!! Form::text('search_key',  null, ['placeholder' => 'Search...','required' => 'required']) !!}
                {!! Form::submit('search', ['class'=>'button2', 'id' => 'submit']) !!}
                {!! Form::close() !!}
            </div>

            <div class="container">
                <h1>Search Results</h1>
                <ul class="list-group">
                    @if(count($albums) > 0)
                        @foreach($albums as $album)
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $album->title }} - <small>in Albums</small></h5>
                                    <small>{{ $album->updated_at->diffForHumans() }} </small>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    @if(count($videos) > 0)
                        @foreach($videos as $video)
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $video->title }} - <small>in Videos</small></h5>
                                        <small>{{ $video->updated_at->diffForHumans() }} </small>
                                    </div>
                                </a>
                        @endforeach
                    @endif

                    @if(count($news) > 0)
                        @foreach($news as $new)
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $new->title }} - <small>in News</small></h5>
                                        <small>{{ $new->updated_at->diffForHumans() }} </small>
                                    </div>
                                </a>
                        @endforeach
                    @endif

                    @if(count($podcasts) > 0)
                        @foreach($podcasts as $podcast)
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $podcast->title }} - <small>in Podcast</small></h5>
                                        <small>{{ $podcast->updated_at->diffForHumans() }} </small>
                                    </div>
                                </a>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

    </div>
    <!-- end container -->

@endsection