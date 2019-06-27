@component('mail::message')
{{ $mail->message }}

@isset($signature)
@component('mail::signature')
	{{ $signature }}
@endcomponent
@endisset

{!! trackEmail($mail->id) !!}

@endcomponent