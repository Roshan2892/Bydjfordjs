@extends('user.layouts.app')
@section('title')
    @if(!empty($podcast))
        @foreach($podcast as $details)
            {{ strtoupper($details->title) }}
        @endforeach
    @endif
@endsection
@section('content')
        @if(!empty($podcast))
            @foreach($podcast as $details)
                <div class="media_container">
        	   <h1>{{ title_case($details->title) }}</h1><hr>
                   <div class="row media_content">
        	       <div class="col-lg-5 col-sm-5 col-xs-12">
                           <div class="detail_img">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url('uploads/images/'.$details->poster) }}" width="450" height="400" alt="Poster by {{ $details->title }}">
                           </div>
                       </div>

                       <div class="col-lg-7 col-sm-7 col-xs-12">
                            <div class="description">
                               <h4><b class="desc">{!! $details->description !!} </b></h4>
                               <h4>Artist:  <b class="artist">{{ $details->artist }}</b></h4>
	                       <h4>Language:  <b class="artist">{{ title_case($details->language)}}</b></h4>
		               <h4>Tags: <i class="tags">@foreach(unserialize($details->tags) as $tags)
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
                              <div class="sm2-bar-ui playlist-open">
                                    <div class="bd sm2-main-controls">
        
	                                <div class="sm2-inline-texture"></div>
	                                <div class="sm2-inline-gradient"></div>
	        
	                                <div class="sm2-inline-element sm2-button-element">
	                                    <div class="sm2-button-bd">
	                                        <a href="#play" class="sm2-inline-button play-pause">Play / pause</a>
	                                    </div>
	                                </div>
	        
	                                <div class="sm2-inline-element sm2-inline-status">
	        
	                                    <div class="sm2-playlist">
	                                        <div class="sm2-playlist-target">
	                                            <!-- playlist <ul> + <li> markup will be injected here -->
	                                            <!-- if you want default / non-JS content, you can put that here. -->
	                                            <noscript><p>JavaScript is required.</p></noscript>
	                                        </div>
	                                    </div>
	        
	                                    <div class="sm2-progress">
	                                        <div class="sm2-row">
	                                            <div class="sm2-inline-time">0:00</div>
	                                            <div class="sm2-progress-bd">
	                                                <div class="sm2-progress-track">
	                                                    <div class="sm2-progress-bar"></div>
	                                                    <div class="sm2-progress-ball"><div class="icon-overlay"></div></div>
	                                                </div>
	                                            </div>
	                                            <div class="sm2-inline-duration">0:00</div>
	                                        </div>
	                                    </div>
	        
	                                </div>
	        
	                                <div class="sm2-inline-element sm2-button-element sm2-volume">
	                                    <div class="sm2-button-bd">
	                                        <span class="sm2-inline-button sm2-volume-control volume-shade"></span>
	                                        <a href="#volume" class="sm2-inline-button sm2-volume-control">volume</a>
	                                    </div>
	                                </div>
	        
	                                <div class="sm2-inline-element sm2-button-element">
	                                    <div class="sm2-button-bd">
	                                        <a href="#prev" title="Previous" class="sm2-inline-button previous">&lt; previous</a>
	                                    </div>
	                                </div>
	        
	                                <div class="sm2-inline-element sm2-button-element">
	                                    <div class="sm2-button-bd">
	                                        <a href="#next" title="Next" class="sm2-inline-button next">&gt; next</a>
	                                    </div>
	                                </div>
	        
	                                <div class="sm2-inline-element sm2-button-element sm2-menu">
	                                    <div class="sm2-button-bd">
	                                        <a href="#menu" class="sm2-inline-button menu">menu</a>
	                                    </div>
	                                </div>
	        
	                            </div>
	                             <div class="bd sm2-playlist-drawer sm2-element">
        
                                          <div class="sm2-inline-texture">
                                              <div class="sm2-box-shadow"></div>
                                          </div>
                                           <div class="sm2-inline-texture">
                                    <div class="sm2-box-shadow"></div>
                                </div>
        
                                <!-- playlist content is mirrored here -->
        
                                <div class="sm2-playlist-wrapper">
                                    <ul class="sm2-playlist-bd">
                                       @foreach(unserialize($details->file) as $file)
                                    <li>
                                        <a href="{!! \Illuminate\Support\Facades\Storage::url('uploads/files/'.$file) !!}">
                                            <b>{!! $details->title !!}</b>
                                        </a>
                                        {{ Form::open(array('route' => array('podcast.download', $details->id ), 'method' => 'get')) }}
		                             <button class="btn btn-default btn_download"><i class="fa fa-download" aria-hidden="true"></i><span class="downLoad">Download</span></button>
		                        {{ Form::close() }}
                                    </li>
                                @endforeach
                                    </ul>
                                </div>
        
                                <div class="sm2-extra-controls">
                                    <div class="bd">
                                        {{--<div class="sm2-inline-element sm2-button-element">--}}
                                            <a href="#prev" title="Previous" class="sm2-inline-button previous">&lt; previous</a>
                                        {{--</div>--}}
                                        {{--<div class="sm2-inline-element sm2-button-element">--}}
                                            <a href="#next" title="Next" class="sm2-inline-button next">&gt; next</a>
                                        {{--</div>--}}
                                    </div>
                                </div>
                                     </div>
                              </div>
                        </div>
                  </div>
             </div>
            @endforeach
        @endif
    
@endsection