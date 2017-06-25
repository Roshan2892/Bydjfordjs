
<div class="navbar navbar-default navbar-static-bottom">
    @if (session()->has('flash_notification.message'))
        <div class="alert alert-{{ session('flash_notification.level') }}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! session('flash_notification.message') !!}
        </div>
    @endif
    <div class="container">
      {!! Form::open(['route' => 'subscribe']) !!}
            {{ csrf_field() }}
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['placeholder'=> 'Name..']) !!}

            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['placeholder'=> 'Subscribe..']) !!}

            {!! Form::submit('submit') !!}
        {!! Form::close() !!}
    </div>
</div>
