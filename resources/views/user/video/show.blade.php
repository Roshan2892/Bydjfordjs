@extends('user.layouts.app')
@section('title')
    @if(!empty($video))
        @foreach($video as $details)
            {{ strtoupper($details->title) }}
        @endforeach
    @endif
@endsection
@section('content')
    
	@if(!empty($video))
    	    @foreach($video as $details)
	       <div class="media_container"> 
	            <h1>{{ title_case($details->title) }}</h1><hr>
	            <div class="row media_content">
	                 <div class="col-lg-5 col-sm-5 col-xs-12">
	                     <div class="detail_img">
	                         <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$details->poster) }}"  width="450" height="400" alt="Poster by {{ $details->title }}">
	                     </div>
	                  </div>
                          <div class="col-lg-7 col-sm-7 col-xs-12">
	                      <div class="description">
	                          <h4><b  class="desc">{!! $details->description !!} </b></h4>
	                          <h4>Artist:  <b class="artist">{{ $details->artist }}</b></h4>
	                          <h4>Language:  <b class="artist">{{ title_case($details->language)}}</b></h4>
	                          <h4>Tags: <i class="tags">
                                        @foreach(unserialize($details->tags) as $tags)
			                    {{ $tags }},
			                @endforeach
			              </i>
		                   </h4>
		                  <div class="share"></div>  
	                      </div>
                         </div>
                   </div>
                   <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="detail_video">
                              @foreach(unserialize($details->file) as $file)
			           {!! $file !!}
			      @endforeach 
                            </div>
                        </div>
                   </div>
               </div>
            @endforeach
       @endif
@endsection