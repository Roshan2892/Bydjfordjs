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
                
                <ul class="list-group">
                    @if(isset($results_arr) && $results_arr.length > 1)
                        <h1>Search Results</h1>
                        @foreach($results_arr as $result)
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $result->title }}</h5>
                                    <small>{{ $result->updated_at->diffForHumans() }} </small>
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