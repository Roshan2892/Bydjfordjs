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
        </div>
    </div>
    <!-- end container -->
@endsection