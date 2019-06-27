@component('mail::message')

{{ $announcement->message }}

@if(!empty($announcement->url))
@component('mail::button', ['url' => $announcement->url])
Read More
@endcomponent
@endif

@endcomponent