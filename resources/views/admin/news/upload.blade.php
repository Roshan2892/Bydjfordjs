@extends('admin.layouts.app')

@section('content')

    <div class="container">
        <a href="{{ route('admin.news.show') }}"><i class="glyphicon glyphicon-fast-backward"></i> Back</a>
        <div class="row">
            <div class="col-md-offset-1 col-md-10" style="background: #eae7e7;padding:25px;">
                <h1>News</h1>
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

                @if(isset($news))
                    {!! Form::model($news, ['route' => ['news.update', $news->id], 'method' => 'patch', 'files' => 'true' ]) !!}
                @else
                    {!! Form::open(['route'=>'news.store','files'=>'true']) !!}
                @endif

                <div class="form-group">
                    {!! Form::label('title','Title: ') !!}
                    {!! Form::text('title', @$music->title, ['placeholder' => 'Title...','class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description','Description: ') !!}
                    {!! Form::textarea('description', @$music->description, ['size' => '30x5','placeholder' => 'Description...','class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('poster','Poster: ') !!}
                    {!! Form::file('poster',null,['class'=>'form-control']) !!}

                    @if(isset($news))
                        {!! Form::image( \Illuminate\Support\Facades\Storage::url('uploads/images/'.$news->poster), null, [ 'alt' => 'Poster by '. $news->title, 'width' => '100', 'height'=>'100'] ) !!}
                    @endif
                </div>

               <div class="form-group">
                    {!! Form::label('file','Embed Video From Youtube: ') !!}
                    <i class="fa fa-plus-square fa-2x" aria-hidden="true" id="add"></i>
                    @if(isset($news))
                        @foreach($files as $file)
                            <div class="box">
                                {{ Form::text('file[]',  $file, ['placeholder' => 'Embed Code...','class'=>'form-control']) }}
                                <i class="fa fa-minus-square fa-2x" id="remove"></i>
                            </div>
                        @endforeach
                    @else
                        <div class="box">
                            {!! Form::text('file[]',  null, ['placeholder' => 'Embed Code...','class'=>'form-control']) !!}
                            <i class="fa fa-minus-square fa-2x" id="remove"></i>
                        </div>
                    @endif
                    <div id="input"></div>
                </div>


                <div class="form-group">
                    {!! Form::label('tags','Tags: ') !!}
                    <i class="fa fa-plus-square fa-2x" aria-hidden="true" id="tags_add"></i>
                    @if(isset($news))
                        @foreach($tags as $tag)
                            <div class="box">
                                {{ Form::text('tags[]',  $tag, ['placeholder' => 'Enter comma seprated tags...','class'=>'form-control']) }}
                                <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                            </div>
                        @endforeach
                        <div id="input_tag"></div>
                    @else
                        <div class="box">
                            {!! Form::text('tags[]',  null, ['placeholder' => 'Enter comma separated tags... ','class'=>'form-control']) !!}
                            <i class="fa fa-minus-square fa-2x" id="remove_tag"></i>
                        </div>
                        <div id="input_tag"></div>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::submit('Upload', ['class'=>'btn btn-primary', 'id' => 'submit']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#add').click(function () {
                $('#input').append('<div class="box"><input type="text" placeholder="Embed Code..." class="form-control" name="file[]"><i class="fa fa-minus-square fa-2x" id="remove"></i></div>');
            });

            $('body').on('click','#remove', function(){
                $(this).closest('div').remove();
            });


            $('#tags_add').click(function () {
                $('#input_tag').append('<div class="box"><input type="text" placeholder="Enter tags... " class="form-control" name="tags[]"><i class="fa fa-minus-square fa-2x" id="remove_tag"></i></div>');
            });

            $('body').on('click','#remove_tag', function(){
                $(this).closest('div').remove();
            });
        });
    </script>
@endsection