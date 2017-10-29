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
                <img class="search-algolia" src="{{ URL::to('/image/assets/search-by-algolia.png') }}" alt="">
            </div>

            <div class="container">
                
                <ul class="list-group">
                    @if(isset($results_arr))
                        <h1>Search Results</h1>
                        @foreach($results_arr as $result)
                            @foreach($result as $res)
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $res->title }}</h5>
                                        <small>{{ $res->updated_at->diffForHumans() }} </small>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    @elseif(isset($no_result))
                        <h4>No Results Found</h4>
                    @endif
                </ul>
            </div>
        </div>

    </div>
    <!-- end container -->

@endsection