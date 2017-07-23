@extends('user.layouts.app')
@section('title')
    @if(!empty($video))
        @foreach($video as $details)
            {{ strtoupper($details->title) }}
        @endforeach
    @endif
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @if(!empty($video))
                @foreach($video as $details)
                    <div class="col-xs-12 col-md-12">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$details->poster) }}" width="500" height="250" alt="Poster by {{ $details->title }}">
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <h2>{{ title_case($details->title) }}</h2>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <span>{!! $details->description !!}</span>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <strong> By {{ $details->artist }}</strong>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <span>{{ title_case($details->language) }}</span>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        @foreach(unserialize($details->tags) as $tag)
                            <span>{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="col-xs-12 col-md-12">
                        @foreach(unserialize($details->file) as $file )
                            {!!  $file !!}
                        @endforeach
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection