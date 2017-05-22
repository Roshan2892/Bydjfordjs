@extends('user.layouts.app')

@section('content')
    <!-- start container -->
    <div class="container" id="contact">
        <!-- start contact_form -->
        <div class="contact_form">
            <center>
                <h2>Get in touch</h2>
            </center>
            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! session('flash_notification.message') !!}
                </div>
            @endif

            {!! Form::open(['route'=>'contact.send'], ['class' => 'form-horizontal']) !!}
                {{ csrf_field() }}
                <div class="contact_group">
                    <center>
                        {!! Form::text('name',  null, ['placeholder' => 'Name...','class'=>'form-control']) !!}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </center>
                </div>

                <div class="contact_group">
                    <center>
                        {!! Form::email('email',null,['placeholder' => 'Email...','class'=>'form-control']) !!}
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </center>
                </div>

                <div class="contact_group">
                    <center>
                        {!! Form::textarea('message', null, ['placeholder' => 'Message...','class'=>'form-control', 'rows' => '5']) !!}
                        <span class="highlight"></span>
                        <span class="bar"></span> 
                    </center>
                </div>
                <div class="contact_group">
                    <center>
                        {!! Form::submit('Send', ['class'=>'btn form-control', 'id' => 'submit']) !!}
                    </center>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- end contact_form -->
    </div>
    <!-- end container -->
@endsection