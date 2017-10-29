@component('mail::message')
# Hello, {{ $name }}

Congrats, you are now subscribed to our newsletters.



@component('mail::button', ['url' => $url, 'color' => 'red'])
Unsubscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
