@component('mail::message')
# Hello, {{ $name }}

@component('mail::panel')
{!! $desc !!}
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'red'])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
