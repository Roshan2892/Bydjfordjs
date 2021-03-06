@extends('admin.layouts.app')
@section('title')
    UPLOAD
@endsection

@section('content')
    <div class="container">
        {{--<a href="{{ route('admin.music.show') }}"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>--}}
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Music</h1>
                        <span class="note">* If more than one file is uploaded, it will considered as album</span>
                    </div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ol>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif

                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session('flash_notification.level') }}">

                                {!! session('flash_notification.message') !!}
                            </div>
                        @endif

                        @if(isset($music))
                            {!! Form::model($music, ['route' => ['music.update', $music->id], 'method' => 'patch', 'files' => 'true']) !!}
                        @else
                            {!! Form::open(['route'=>'music.store','files'=>'true']) !!}
                        @endif

                        <div class="form-group">
                            {!! Form::label('title','Title: ') !!}
                            {!! Form::text('title', @$music->title, ['placeholder' => 'Title...','class'=>'form-control title']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description','Description: ') !!}
                            {!! Form::textarea('description', @$music->description, ['size' => '30x5','placeholder' => 'Description...','class'=>'form-control description']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('poster','Poster: ') !!}
                            {!! Form::file('poster',null,['class'=>'form-control']) !!}
                            @if(isset($music))
                                {!! Form::image( \Illuminate\Support\Facades\Storage::url('uploads/images/'.$music->poster), null, [ 'alt' => 'Poster by '. $music->artist, 'width' => '100', 'height'=>'100', 'class' => 'poster'] ) !!}
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('file','Music: ') !!}
                            {!! Form::file('file[]',['class'=>'form-control file','multiple'=>'true']) !!}
                            @if(isset($music))
                                @foreach(unserialize($music->filename) as $file)
                                    {!! Form::label('files', $file) !!}
                                    <a href="{{ route('admin.music.delete', ['id'=> $music->id, 'file' => $file ] ) }}"><i class="fa fa-times"></i></a> <br>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('artist','Artist: ') !!}
                            {!! Form::text('artist', @$music->artist, ['placeholder' => 'Artist...','class'=>'form-control artist']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('tags','Tags:') !!}
                            <i class="fa fa-plus-square fa-2x" aria-hidden="true" id="tags_add"></i>
                            @if(isset($music))
                                @foreach($tags as $tag)
                                    <div class="box">
                                        {{ Form::text('tags[]',  $tag, ['placeholder' => 'Enter comma seprated tags...','class'=>'form-control tags']) }}
                                        <i class="fa fa-multiply fa-2x"></i>
                                        <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                                    </div>
                                @endforeach
                                <div id="input_tag"></div>
                            @else
                                <div class="box">
                                    <input type="text" placeholder="Enter tags... " class="form-control tags" name="tags[]">
                                    <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                                </div>
                                <div id="input_tag"></div>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('language','Language: ') !!}
                            {!! Form::select('language', ['ENGLISH' => 'English', 'HINDI' => 'Hindi'], @$music->language, ['placeholder' => 'Pick a Language...','class'=>'form-control language']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Upload', ['class'=>'btn btn-primary', 'id' => 'submit']) !!}
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
                $('#input_tag').append('<div class="box"><input type="text" placeholder="Enter tags... " class="form-control" name="tags[]" ><i class="fa fa-minus-square fa-2x" id="remove_tag"></i></div>');
            });

            $('body').on('click','#remove_tag', function(){
                $(this).closest('div').remove();
            });
        });
    </script>
@endsection