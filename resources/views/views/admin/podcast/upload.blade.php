@extends('admin.layouts.app')

@section('title')
    UPLOAD
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Podcast</h1>
                    </div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session('flash_notification.level') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!! session('flash_notification.message') !!}
                            </div>
                        @endif

                        @if(isset($podcast))
                            {!! Form::model($podcast, ['route' => ['podcast.update', $podcast->id], 'method' => 'patch', 'files' => 'true' ]) !!}
                        @else
                            {!! Form::open(['route'=>'podcast.store','files'=>'true']) !!}
                        @endif


                        <div class="form-group">
                            {!! Form::label('title','Title: ') !!}
                            {!! Form::text('title',  null, ['placeholder' => 'Title...','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description','Description: ') !!}
                            {!! Form::textarea('description', null, ['size' => '30x5','placeholder' => 'Description...','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('poster','Poster: ') !!}
                            {!! Form::file('poster',null,['class'=>'form-control']) !!}
                            @if(isset($podcast))
                                {!! Form::image( \Illuminate\Support\Facades\Storage::url('uploads/images/'.$podcast->poster), null, [ 'alt' => 'Poster by '. $podcast->artist, 'width' => '100', 'height'=>'100'] ) !!}
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('file','Podcast: ') !!}
                            {!! Form::file('file[]',['class'=>'form-control','multiple'=>'true']) !!}
                            @if(isset($podcast))
                                @foreach(unserialize($podcast->filename) as $file)
                                    {!! Form::label('files', $file) !!}
                                    <a href="{{ route('admin.podcast.delete', ['id'=> $podcast->id, 'file' => $file ] ) }}"><i class="fa fa-times"></i></a> <br>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('artist','Artist: ') !!}
                            {!! Form::text('artist', null, ['placeholder' => 'Artist...','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('tags','Tags:') !!}
                            <i class="fa fa-plus-square fa-2x" aria-hidden="true" id="tags_add"></i>
                            @if(isset($podcast))
                                @foreach($tags as $tag)
                                    <div class="box">
                                        {{ Form::text('tags[]',  $tag, ['placeholder' => 'Enter comma seprated tags...','class'=>'form-control']) }}
                                        <i class="fa fa-multiply fa-2x"></i>
                                        <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                                    </div>
                                @endforeach
                                <div id="input_tag"></div>
                            @else
                                <div class="box">
                                    <input type="text" placeholder="Enter tags... " class="form-control" name="tags[]">
                                    <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                                </div>
                                <div id="input_tag"></div>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('language','Language: ') !!}
                            {!! Form::select('language', ['ENGLISH' => 'English', 'HINDI' => 'Hindi'],  null, ['placeholder' => 'Pick a Language...','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tags_add').click(function () {
                $('#input_tag').append('<div class="box"><input type="text" placeholder="Enter comma separated tags... " class="form-control" name="tags[]"><i class="fa fa-minus-square fa-2x" id="remove_tag"></i></div>');
            });

            $('body').on('click','#remove_tag', function(){
                $(this).closest('div').remove();
            });
        });
    </script>
@endsection