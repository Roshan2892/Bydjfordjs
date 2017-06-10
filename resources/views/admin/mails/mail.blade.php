@extends('admin.layouts.app')

@section('content')
	{!! Form::open(['route'=>'admin.email.send','files'=>'true']) !!}
		{!! Form::label('subject','Subject: ') !!}
        {!! Form::text('subject', null, ['placeholder' => 'Subject...','class'=>'form-control']) !!}

        {!! Form::label('description','Description: ') !!}
        {!! Form::textarea('description', null, ['size' => '30x5', 'placeholder' => 'Message...','class'=>'form-control']) !!}

        {!! Form::submit('Send', ['class'=>'btn btn-primary', 'id' => 'submit']) !!}
	{!! Form::close() !!}
@endsection