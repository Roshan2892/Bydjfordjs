@component('mail::message')
# Hello, {{ $name }}

Please click on the link below, to subscribe to our newsletters.


@component('mail::button', ['url' => $url, 'color' => 'green'])
Subscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
