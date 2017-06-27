@extends('admin.layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Send Mails to your subscribers</h1>
                    </div>
                    <div class="panel-body">

                        @if (session()->has('flash_notification.message'))
                            <div class="alert alert-{{ session('flash_notification.level') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!! session('flash_notification.message') !!}
                            </div>
                        @endif

                        {!! Form::open(['route'=>'admin.email.send','files'=>'true']) !!}
                            <div class="form-group">
                                {!! Form::label('subject','Subject: ') !!}
                                {!! Form::text('subject', null, ['placeholder' => 'Subject...','class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description','Description: ') !!}
                                {!! Form::textarea('description', null, ['size' => '30x5', 'placeholder' => 'Message...','class'=>'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Send', ['class'=>'btn btn-primary', 'id' => 'submit']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection