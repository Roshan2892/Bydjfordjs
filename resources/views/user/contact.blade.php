@extends('user.layouts.app')
@section('title')
    CONTACT US
@endsection

@section('content')
    <div class="row">
        <!-- start contact_form -->
        <div class="col-lg-12 contact_container">
            <h1>Get In Touch</h1><hr>
            <div class="contact_content">
                @if (session()->has('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!! session('flash_notification.message') !!}
                    </div>
                @endif
                {!! Form::open(['route'=>'contact.send'], ['class' => 'form-horizontal']) !!}
                    {!! Form::text('name',  null, ['placeholder' => 'Name...','required' => 'required']) !!}
                    {!! Form::email('email',null,['placeholder' => 'Email...','required' => 'required']) !!}
                    {!! Form::textarea('message', null, ['placeholder' => 'Message...', 'rows' => '5','required' => 'required']) !!}
                    {!! Form::submit('Send', ['class'=>'btn btn-block', 'id' => 'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end contact_form -->
    </div>
@endsection