@component('mail::message')
# Hello, {{ $name }}

<br><br>
Welcome to BYDJFORDJS Family

<br><br>
Please click on the link below, to subscribe to our newsletters.

<br><br>
@component('mail::button', ['url' => $url, 'color' => 'green'])
Subscribe
@endcomponent

@endcomponent
